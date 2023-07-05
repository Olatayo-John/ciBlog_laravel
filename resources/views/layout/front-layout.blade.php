<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>

    @include('layout.partials._cdn')

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    @stack('css')
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">{{ env('APP_NAME') }}</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('post.index') }}">All Posts</a>
                        </li>
                        @auth
                            <li class="nav-item" style="margin:auto 0">
                                <a class="nav-link" href="{{ route('post.create') }}">Create Post</a>
                            </li>
                        @endauth
                    </ul>

                    <ul class="navbar-nav ml-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('register') }}">Register</a>
                            </li>
                        @endguest

                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                    role="button" data-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ auth()->user()->profileImage ? asset('storage/' . auth()->user()->profileImage) : asset('images/default/' . 'no_image.jpg') }}"
                                        style="width:30px;height:30px;border-radius:50%">
                                    {{ auth()->user()->name ?? auth()->user()->username }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <li><a class="dropdown-item" href="{{ route('profile.index') }}">My Profile</a></li>
                                    <li><a class="dropdown-item" href="{{ route('my-posts') }}">My Posts</a></li>
                                    <li><a class="dropdown-item" href="{{ route('usersetting.index') }}">My Settings</a></li>
                                    <li class="btn-danger_">
                                        <form action="{{ route('logout') }}" method="post">@csrf @method('post')
                                            <a class="dropdown-item"><button class="btn p-0">Logout</button></a>
                                        </form>
                                    </li>
                                </ul>
                            </li>

                            @if (auth()->user()->role->pluck('name')->first() !== 'User')
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                        role="button" data-toggle="dropdown" aria-expanded="false">Users</a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <li><a class="dropdown-item" href="{{ route('admin.user.index') }}">All Users</a>
                                        </li>
                                        <li><a class="dropdown-item" href="{{ route('admin.user.create') }}">Add User</a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                        role="button" data-toggle="dropdown" aria-expanded="false">Authorization</a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <li><a class="dropdown-item" href="{{ route('admin.authorization') }}">Role and Permission</a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        @endauth

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('support') }}">Support</a>
                        </li>
                        
                    </ul>

                </div>
            </div>
        </nav>
    </header>

    @include('layout.partials._flashAlert')
    {{ $slot }}

    <footer></footer>


    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
    @stack('scripts')

</body>

</html>
