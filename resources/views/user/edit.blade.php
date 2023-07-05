<x-front-layout>
    <section id="content">
        <h6>Edit User</h6>
        <hr>

        <div class="row col-md-12">
            <div class="col-md-8">
                <form action="{{ route('admin.user.update', $user->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="form-group">
                        <label for="profileImage">Profile Image</label>
                        <input type="file" name="profileImage" id="profileImage" class="form-control">
                        @error('profileImage')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name"
                                value="{{ old('name', $user->name) }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username"
                                value="{{ old('username', $user->username) }}">
                            @error('username')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="dob">DOB</label>
                            <input type="date" name="dob" id="dob" class="form-control"
                                value="{{ old('dob', $user->dob) }}">
                            @error('dob')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" class="form-control">
                                <option value=""></option>
                                @foreach (config('site.genders') as $settings_gender)
                                    <option {{ $settings_gender === $user->gender ? 'selected' : '' }}>
                                        {{ $settings_gender }}</option>
                                @endforeach
                            </select>
                            @error('gender')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control"
                            value="{{ old('email', $user->email) }}" readonly required>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Change Password</label>
                        <input type="password" name="password" class="form-control" autocomplete="false">

                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Notify User?</label><label>
                            <input type="checkbox" class="ml-1" value="1" name="password_change_notify">
                            @error('password_change_notify')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                    </div>

                    <div class="form-group">
                        <button class="btn btn-secondary" type="submit">Update</button>
                    </div>
                </form>
            </div>

            <div class="col-md-4">
                @can('user_role_update')
                    <form action="{{ route('admin.user-role.update', $user->id) }}" method="post">
                        @csrf
                        @method('put')

                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-control" readonly disabled>
                                @foreach (config('site.newUserRole') as $role)
                                    <option {{ $role === $user->role->first()->name ? 'selected' : '' }}>
                                        {{ $role }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="permissions">Permissions</label>
                            <div class="row">

                                @foreach (config('site.permissions') as $permission)
                                    @if (in_array($userrole, $permission['roles']))
                                        <div class="col-md-6">
                                            <input type="checkbox" name="permissions[{{ $permission['name'] }}]"
                                                {{ in_array($permission['name'], $userPermissions) ? 'checked' : '' }}>
                                            {{ $permission['title'] }}
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-block btn-secondary" type="submit">Save</button>
                        </div>
                    </form>
                @endcan
            </div>
        </div>
    </section>
</x-front-layout>
