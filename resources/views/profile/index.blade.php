<x-front-layout>
    @push('css')
        <link rel="stylesheet" href="{{ asset('css/profile/index.css') }}">
    @endpush
    <section id="content">

        <div class="topDetails">
            <div class="userProfile">
                <img src="{{ auth()->user()->profileImage ? asset('storage/' . auth()->user()->profileImage) : asset('images/default/'.$settingImage.'.jpg') }}"
                    alt="">
            </div>
            <div class="userProfileName">
                <h5>{{ auth()->user()->name }} <span class="badge badge-warning">{{$userrole }}</span></h5>
            </div>
        </div>

        <div class="bottomDetails">
            <div class="actions text-right">
                <a href="{{ route('profile.edit', auth()->user()->id) }}">
                    <button class="btn btn-secondary">EditProfile</button>
                </a>
                <button class="btn btn-danger deleteAccountBtn">Delete Account</button>
            </div>

            <p><strong>Username:</strong> {{ auth()->user()->username }}</p>
            <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
            <p><strong>Gender:</strong> {{ auth()->user()->gender }}</p>
            <p><strong>Date Of Birth:</strong> {{ auth()->user()->dob }}</p>
        </div>

    </section>


    @push('scripts')
        <script>
            $(document).ready(function() {

                //delete account
                $('.deleteAccountBtn').on('click', function(e) {
                    e.preventDefault();

                    var con = confirm('Are you sure you want to perform this operation?');

                    if (con === false) {
                        return false;
                    } else if (con === true) {
                        $.ajax({
                            url: '{{ route('profile.destroy', auth()->user()->id) }}',
                            method: 'post',
                            dataType: "json",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "_method": "delete",
                            }
                        }).fail(function() {
                            //since we invalidated and regenereted user token, the request will register as failed
                            window.location.reload();
                        })
                    }
                });

            });
        </script>
    @endpush
</x-front-layout>
