<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\comment\AddCommentRequest;


class CommentController extends Controller
{
    use UserTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // echo "yesse
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddCommentRequest $request)
    {
        if (!$this->authorize('comment_create')) {
            abort(403);
        }

        DB::transaction(function () use ($request) {
            Comment::create($request->validated());
        });

        return to_route('post.show', $request->post_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!$this->authorize('comment_edit')) {
            abort(403);
        }

        if (request('comment_id')) {
            $id = request('comment_id');
            $comment = Comment::find($id);

            $this->isOwner($comment->user_id);

            if ($comment) {
                $data['status'] = true;
                $data['comment'] = $comment;
                $data['updateFormAction'] = url('comment/' . $comment->id . '');
            } else {
                $data['status'] = false;
                $data['msg'] = 'Comment not found';
            }
        } else {
            $data['status'] = false;
            $data['msg'] = 'Missing parameters';
        }

        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        if (!$this->authorize('comment_update')) {
            abort(403);
        }

        $this->isOwner($comment->user_id);

        $updateFields = $request->validate([
            'comment' => 'required|string'
        ]);

        DB::transaction(function () use ($comment, $updateFields) {
            Comment::where('id', '=', $comment->id)->update($updateFields);
        });

        return back()->with('message', 'Comment updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        if (!$this->authorize('comment_delete')) {
            abort(403);
        }

        $this->isOwner($comment->user_id);

        DB::transaction(function () use ($comment) {
            Comment::where('id','=',$comment->id)->delete();
        });

        return back()->with('message', 'Comment deleted');
    }
}
