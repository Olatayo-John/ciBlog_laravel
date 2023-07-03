<x-front-layout>
    <section id="content">
        <div class="container col-md-6 p-3 mt-5" style="background: #E7E1DF;">
            <div class="mb-3">
                Thanks for signing up! Before getting started, could you verify your email address by clicking on the
                link we just emailed to you? If you didn't receive the email, we will gladly send you another.
            </div>

            <div class="d-flex justify-content-between">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <button type="submit" class="btn btn-outline-secondary">Resend Verification Email</button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="btn btn-danger">Log Out</button>
                </form>
            </div>
        </div>
    </section>
</x-front-layout>
