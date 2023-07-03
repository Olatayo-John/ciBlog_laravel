<x-front-layout>
    <section id="content">
        <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('post')

            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

            <div class="row col-md-12">
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="">Post Title</label>
                        <input type="text" name="title" id="title" class="form-control"
                            value="{{ old('title') }}" required>
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Post Body</label>
                        <textarea id='editor' name="body" id="body" class="form-control">{{ old('body') }}</textarea>
                        @error('body')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Post Image</label><br>
                        <button class="btn btn-secondary mb-3 addPostImage" type="button" rn="0">Add</button>
                        @error('postImage')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="addedPostImages"></div>
                    </div>
                </div>


                <div class="col-md-3">
                    @include('post.partials._postsettingcreate')
                </div>
            </div>

            <div class="form-group">
                <button class="btn btn-secondary btn-block" type="submit">Create</button>
            </div>
        </form>
    </section>


    @push('css')
        <link rel="stylesheet" href="{{ asset('css/post/create.css') }}">
    @endpush

    @push('scripts')
        <script src="{{ asset('js/post.js') }}"></script>
    @endpush
</x-front-layout>
