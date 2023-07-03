<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Traits\UserTrait;
use App\Models\PostSetting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\PostSettingTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\post\AddPostrequest;
use App\Http\Requests\post\UpdatePostRequest;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Database\Eloquent\Builder;

class PostController extends Controller
{
    use UserTrait;
    use PostSettingTrait;

    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
        $this->middleware('role_permission')->except('index', 'show');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::check()) {
            $posts = Post::latest()->filter(request(['search']))
                ->with(['postsetting' => function (Builder $query) {
                    $query->where('meta_key', 'show_to_guest');
                }])
                ->get();

            $itemsPerPage = 10;
            $page = 1;
            $filteredResults = $posts->reject(function ($post) {
                return $post->postsetting->first()['meta_value'] === 'No';
            });

            $paginatedResults = new LengthAwarePaginator(
                $filteredResults->forPage($page, $itemsPerPage),
                $filteredResults->count(),
                $itemsPerPage,
                $page
            );
            $data['posts'] = $paginatedResults;
        } else {
            $posts = Post::latest()->filter(request(['search']))->paginate(10);
            $data['posts'] = $posts;
        }

        return view('post.posts', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!$this->authorize('post_create')) {
            abort(403);
        }

        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddPostrequest $request)
    {
        if (!$this->authorize('post_create')) {
            abort(403);
        }

        $newpost = $request->validated();

        if ($request->hasFile('postImage')) {
            $postImages = $request->file('postImage');
            $allImages = '';

            foreach ($postImages as $image) {
                $path = $image->store('uploads', 'public');
                $allImages .= $path . ',';
            }
            $newpost['image'] = $allImages;
        }

        // dd($newpost);

        DB::transaction(function () use ($request, $newpost) {

            $newpost_DB = Post::create($newpost);

            foreach (config('site.postSettings') as $postsetting) {
                PostSetting::create([
                    'post_id' => $newpost_DB->id,
                    'title' => $postsetting['title'],
                    'meta_key' => $postsetting['meta_key'],
                    'meta_value' => $request->input($postsetting['meta_key']),
                ]);
            }
        });

        return redirect()->route('post.index')->with('message', 'Post created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $data['post'] = $post;
        $data['comments'] = $post->comments->sortByDesc('created_at');
        $data['postsetting'] = $this->allPostSettings($post);

        if ($post->image) {
            $postImages = explode(',', $post->image);
            $post->image = $postImages;
        }

        return view('post.post')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if (!$this->authorize('post_edit')) {
            abort(403);
        }

        $this->isOwner($post->user_id);

        $data['post'] = $post;
        $data['postsettings'] = $post->postsetting;

        if ($post->image) {
            $postImages = explode(',', $post->image);
            $post->image = $postImages;
        }

        return view('post.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        if (!$this->authorize('post_update')) {
            abort(403);
        }

        $this->isOwner($post->user_id);

        $updateFields = $request->validated();

        if ($request->hasFile('postImage')) {
            $newPostImages = $request->file('postImage');
            $allImages = '';

            foreach ($newPostImages as $image) {
                $path = $image->store('uploads', 'public');
                $allImages .= $path . ',';
            }

            $updateFields['image'] = $post->image . $allImages;
        }

        DB::transaction(function () use ($request, $post, $updateFields) {
            $post->update($updateFields);

            foreach ($request->all() as $key => $value) {
                PostSetting::where([['post_id', '=', $post->id], ['meta_key', '=', $key]])->update([
                    'meta_value' => $value,
                ]);
            }
        });

        return to_route('post.show', $post)->with('message', 'Post updated');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (!$this->authorize('post_delete')) {
            abort(403);
        }

        $this->isOwner($post->user_id);

        $postImageArr = explode(',', $post->image);

        DB::transaction(function ()  use ($post) {
            $post->delete();
        });

        // delete post images
        foreach ($postImageArr as $pImg) {
            $postImageFilePath = getcwd() . '/uploads/post_' . $post->id . '_' . $pImg;

            if (file_exists($postImageFilePath))
                unlink($postImageFilePath);
        }

        $data['status'] = true;
        $data['msg'] = 'Post deleted';
        $data['redirect'] = route('post.index');

        $data['token'] = csrf_token();
        return response($data);
    }

    /**
     * Show user posts
     **/
    public function userPosts()
    {
        $posts = Post::where('user_id', '=', auth()->user()->id)->latest()->filter(request(['search']))->paginate('10');

        $data['posts'] = $posts;

        return view('user.userPosts')->with($data);
    }

    public function postImageDelete(Post $post)
    {
        $imgToDelete = request('imageName');

        if (Storage::disk('public')->delete($imgToDelete)) {
            if ($post->image) {
                $postImagesDB = explode(',', $post->image);
                $imgToDeleteKey = array_search($imgToDelete, $postImagesDB);
                if ($imgToDeleteKey !== false) {
                    unset($postImagesDB[$imgToDeleteKey]);
                }

                $updatedImages = implode(',', $postImagesDB); //back to string

                DB::transaction(function () use ($post, $updatedImages) {
                    $post->update([
                        'image' => $updatedImages
                    ]);
                });

                $data['status'] = true;
                $data['msg'] = 'Image deleted';
            }
        } else {
            $data['status'] = false;
            $data['msg'] = 'Unable to delete image';
        }


        $data['token'] = csrf_token();
        return response($data);
    }
}
