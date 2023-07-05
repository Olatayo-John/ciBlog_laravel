<x-front-layout>
    @push('css')
        <link rel="stylesheet" href="{{ asset('css/profile/index.css') }}">
    @endpush
    <section id="content">

        <div class="topDetails">
            <div class="userProfile">
                <img src="{{ auth()->user()->profileImage ? asset('storage/' . auth()->user()->profileImage) : asset('images/default/' . $settingImage . '.jpg') }}"
                    alt="">
            </div>
            <div class="userProfileName">
                <h5>{{ auth()->user()->name }} <span class="badge badge-warning">{{ $userrole }}</span></h5>
            </div>
        </div>

        <div class="actions text-right mt-2">
            <a href="{{ route('profile.edit', auth()->user()->id) }}">
                <button class="btn btn-secondary"><i class="fa-solid fa-edit"></i></button>
            </a>
            <button class="btn btn-danger deleteAccountBtn"><i class="fa-solid fa-trash"></i></button>
        </div>

        <div class="bottomDetails">
            <div class="details">
                <h6 class="text-center">Personal Information</h6>
                <p><strong>Username:</strong> {{ auth()->user()->username }}</p>
                <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                <p><strong>Gender:</strong> {{ auth()->user()->gender }}</p>
                <p><strong>Date Of Birth:</strong> {{ auth()->user()->dob }}</p>
            </div>

            <div class="details">
                <h6 class="text-center">Permissions</h6>
                <div class="row">
                    @foreach (config('site.permissions') as $permission)
                        @if (in_array($userrole, $permission['roles']))
                            <div class="col-md-4 {{ in_array($permission['name'], $userPermissions) ? 'text-success' : 'text-danger' }}">{{ $permission['title'] }}</div>
                        @endif
                    @endforeach
                </div>
            </div>
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
