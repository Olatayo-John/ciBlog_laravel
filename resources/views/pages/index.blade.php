<x-front-layout>
    <section id="content">

        <div class="jumbotron">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio dolorem, dolor sit cumque modi
                adipisci! Hic,
                ducimus magni tempore provident placeat corrupti cum incidunt pariatur unde, numquam reiciendis
                natus
                deleniti?Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio dolorem, dolor sit cumque
                modi
                adipisci!
                Hic, ducimus magni tempore provident placeat corrupti cum incidunt pariatur unde, numquam reiciendis
                natus
                deleniti?Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio dolorem, dolor sit cumque
                modi
                adipisci!
                Hic, ducimus magni tempore provident placeat corrupti cum incidunt pariatur unde, numquam reiciendis
                natus
                deleniti?Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio dolorem, dolor sit cumque
                modi
                adipisci!
                Hic, ducimus magni tempore provident placeat corrupti cum incidunt pariatur unde, numquam reiciendis
                natus
                deleniti?</p>
            @guest
                <div class="text-center">
                    <a href="{{ route('login') }}" class="btn btn-secondary">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
                </div>
            @endguest
            @auth
                <div class="text-center">
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">Dashboard</a>
                </div>
            @endauth
        </div>

    </section>
</x-front-layout>
