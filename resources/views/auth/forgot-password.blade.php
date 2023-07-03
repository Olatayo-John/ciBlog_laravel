<x-front-layout>
    <section id="content">
        <div class="container col-md-6 p-3 mt-5" style="background: #E7E1DF;">
            <div class="mb-3">
                Forgot your password? No problem. Just let us know your email address and we will email you a password
                reset link that will allow you to choose a new one.
            </div>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    {{-- <label for="email">Email</label> --}}
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" placeholder="Enter your email address...">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-outline-secondary btn-block">Email Password Reset Link</button>
                </div>
            </form>
        </div>
    </section>
</x-front-layout>
