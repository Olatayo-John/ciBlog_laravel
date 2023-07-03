<x-front-layout>
    <section id="content">
        @include('user.partials._myPostSearch')

        @if (count($posts) > 0)
            <div class="col-md-12 row p-0 m-0">
                @foreach ($posts as $post)
                    <div class="card mb-2 p-2 col-md-6">
                        <h3 class="">{{ $post->title }}</h3>
                        <div class="text-right mb-2">
                            <a href="{{ route('post.show', $post->id) }}" class="mb-2">
                                <button class="btn btn-secondary">Read</button>
                            </a>
                        </div>
                        <div class="d-flex justify-content-between" style="">
                            <small class="font-weight-bolder">Author: {{ $post->user->name }}</small>
                            <small class="text-danger">{{ $post->created_at }}</small>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $posts->links() }}
        @else
            <h6 class="text-center p-3">You have no post!</h6>
        @endif
    </section>

</x-front-layout>
