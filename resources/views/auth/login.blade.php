<x-front-layout>
    <section>
        <form action="{{ route('login') }}" method="post" class="col-md-6">
            @csrf
            @method('post')

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="Password" name="password" id="password" class="form-control">
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                Remember me? <input type="checkbox" name="remember_me" class="">
            </div>

            @if (Route::has('password.request'))
                <div class="form-group">
                    <a class="" href="{{ route('password.request') }}">Forgot your password?</a>
                </div>
            @endif

            <div class="form-group">
                <button class="btn btn-primary" type="submit">Login</button> <a
                    href="{{ route('register') }}">Register</a>
            </div>
        </form>
    </section>
</x-front-layout>
