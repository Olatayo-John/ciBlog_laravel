<x-front-layout>
    @push('css')
        <link rel="stylesheet" href="{{ asset('css/profile/index.css') }}">
    @endpush
    <section id="content">

        <div class="topDetails">
            <div class="userProfile">
                <img src="{{ $user->profileImage ? asset('storage/' . $user->profileImage) : asset('images/default/' . $settingImage . '.jpg') }}"
                    alt="">
            </div>
            <div class="userProfileName">
                <h5>{{ $user->name }} <span class="badge badge-warning">{{ $userrole }}</span></h5>
            </div>
        </div>

        <div class="bottomDetails">
            <div class="details">
                <h6 class="text-center">Personal Information</h6>
                <p><strong>Username:</strong> {{ $user->username }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Gender:</strong> {{ $user->gender }}</p>
                <p><strong>Date Of Birth:</strong> {{ $user->dob }}</p>
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


</x-front-layout>
