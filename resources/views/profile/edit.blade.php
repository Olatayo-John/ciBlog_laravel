<x-front-layout>
    <section id="content">

        <form action="{{ route('profile.update', auth()->user()->id) }}" enctype="multipart/form-data" method="post" class="container col-md-6">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="profileImage">Profile Image</label>
                <input type="file" name="profileImage" id="profileImage" class="form-control">
                @error('profileImage')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="row form-group">
                <div class="col-md-6">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ old('name', auth()->user()->name) }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control"
                        value="{{ old('username', auth()->user()->username) }}">
                    @error('username')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control"
                    value="{{ old('email', auth()->user()->email) }}" readonly required>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="row form-group">
                <div class="col-md-6">
                    <label for="dob">DOB</label>
                    <input type="date" name="dob" id="dob" class="form-control"
                        value="{{ old('dob', auth()->user()->dob) }}">
                    @error('dob')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="gender">Gender</label>
                    <select name="gender" id="gender" class="form-control">
                        <option value=""></option>
                        @foreach(config('site.genders') as $settings_gender)
                        <option {{($settings_gender === auth()->user()->gender) ? 'selected' : ''}}>{{$settings_gender}}</option>
                        @endforeach
                    </select>
                    @error('gender')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label>Change Password</label>
                <input type="password" name="password" class="form-control" autocomplete="false">

                @error('password')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Notify Me?</label><label>
                <input type="checkbox" class="ml-1" value="1" name="password_change_notify">
                @error('password_change_notify')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <button class="btn btn-block btn-secondary" type="submit">Update</button>
            </div>

        </form>
    </section>
</x-front-layout>
