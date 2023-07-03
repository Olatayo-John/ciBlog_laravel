<x-front-layout>

    <section id="content">
        @include('post.partials._postmodalimage')
        @include('post.partials._postcommentmodal')

        <div class="mb-3">
            <a href="{{ route('post.index') }}"><button class="btn btn-primary">Back</button></a>
        </div>

        <div class="list-group-item mb-3">
            <h4 class="text-center">{{ $post->title }}</h4>
            <p class="">{!! $post->body !!}</p>
            <div class="d-flex text-right" style="flex-direction:column">
                <span class="font-weight-bolder">Author: {{ $post->user->name }}</span>
                <span class="text-danger">{{ $post->created_at }}</span>
            </div>
            @if ($post->image && is_array($post->image))
                <hr>

                <div class="postImages">
                    @foreach ($post->image as $pimg)
                        @if ($pimg)
                            <div class="postImg">
                                <img class="postImage" src="{{ asset('storage/' . $pimg) }}">
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>

        @auth
            @if (auth()->user()->id === $post->user_id)
                <div class="text-center">
                    <a href="{{ route('post.edit', $post->id) }}"><button class="btn btn-secondary">Edit Post</button></a>
                    <button class="btn btn-danger deletePostBtn" type="button">Delete Post</button>
                </div>
            @endif

            {{-- comment --}}
            <div class="">
                <h6>Comments</h6>
                @if ($postsetting['allow_comment']->meta_value === 'Yes')
                    <form action="{{ route('comment.store') }}" method="post">
                        @csrf
                        @method('post')

                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="post_id" value="{{ $post->id }}">

                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" name="comment" placeholder="Add comment..."
                                    required>
                                <button class="btn btn-secondary input-group-prepend">Add</button>
                            </div>
                            @error('comment')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </form>
                @endif

                <div class="list-group-item">
                    @if (count($comments) > 0)
                        @foreach ($comments as $comment)
                            <div class="eachCommentBox">
                                <h6>{{ $comment->user->name }} <span class="text-danger">@
                                        {{ $comment->created_at }}</span></h6>
                                <p>{{ $comment->comment }}</p>
                                @if ($comment->user_id === auth()->user()->id)
                                    <div class="commentBtnActions d-flex" comment_id="{{ $comment->id }}"
                                        post_id="{{ $post->id }}">
                                        <span class="m-auto"
                                            onclick="editComment({{ $comment->id }},{{ $post->id }})"><i
                                                class="fa-solid fa-pen text-secondary"></i></span>
                                        <form action="{{ route('comment.destroy', $comment->id) }}" method="post"
                                            id="delete_comment_form">
                                            @csrf @method('delete')
                                            <button type="sumbit" class="btn"><i
                                                    class="fa-solid fa-trash text-danger"></i></button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <p>No comment</p>
                    @endif
                </div>
            </div>

        @endauth
    </section>



    @push('css')
        <link rel="stylesheet" href="{{ asset('css/post/post.css') }}">
    @endpush

    @push('scripts')
        <script src="{{ asset('js/post.js') }}"></script>
        <script>
            function editComment(comment_id, post_id) {

                $.ajax({
                    url: '{{ route('comment.show', 0) }}',
                    method: 'post',
                    dataType: "json",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "_method": "get",
                        "comment_id": comment_id,
                    },
                    beforeSend: function() {
                        $('.edit_comment_id,.edit_comment_post_id,.edit_comment_comment').val("");
                    },
                    success: function(res) {
                        if (res.status === true) {

                            $('.edit_comment_id').val(res.comment.id);
                            $('.edit_comment_post_id').val(res.comment.post_id);
                            $('.edit_comment_comment').val(res.comment.comment);
                            $('.edit_comment_form').attr('action', res.updateFormAction);

                            $('.postCommentModal').modal('show');
                        } else {
                            alert(res.msg);
                        }
                    }
                })
            }

            $(document).ready(function() {

                //delete post
                $('.deletePostBtn').on('click', function(e) {
                    e.preventDefault();

                    var con = confirm('Are you sure you want to delete this post?');

                    if (con === false) {
                        return false;
                    } else if (con === true) {
                        $.ajax({
                            url: '{{ route('post.destroy', $post->id) }}',
                            method: 'post',
                            dataType: "json",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "_method": "delete",
                            },
                            success: function(res) {
                                if (res.status === true) {
                                    alert(res.msg);

                                    window.location.assign(res.redirect);
                                } else {
                                    alert(res.msg);
                                }
                            }
                        })
                    }
                });

                $('#delete_comment_form button').click(function(e) {
                    e.preventDefault();
                    var con = confirm("Are you sure you want to delete?");

                    if (con === true) {
                        $('#delete_comment_form').submit();
                    } else if (con === false) {
                        return false;
                    }
                });

            });
        </script>
    @endpush
</x-front-layout>
