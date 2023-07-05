<x-front-layout>
    <section id="content">
        <h6>Users</h6>
        <hr>

        <table id="usersTable" data-toggle="table" data-search="true" data-show-export="true"
            data-buttons-prefix="btn-sm btn" data-buttons-align="right" data-pagination="true">
            <thead>
                <tr>
                    <th data-field="name" data-sortable="true">Name</th>
                    <th data-field="email" data-sortable="true">Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                <tr>
                    <td>
                        <img src="{{ $user->profileImage ? asset('storage/' . $user->profileImage) : asset('images/default/' . 'no_image.jpg') }}"
                            style="width:30px;height:30px;border-radius:50%">
                        {{ $user->name }} <span class="badge badge-warning">{{ $user->role->first()->name }}
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <div class="actionBtn d-flex">
                            <a href="{{ route('admin.user.show', $user->id) }}" target="_blank">
                                <button class="btn btn-dark"><i class="fas fa-eye"></i></button>
                            </a>
                            <a href="{{ route('admin.user.edit', $user->id) }}">
                                <button class="btn btn-dark"><i class="fas fa-edit"></i></button>
                            </a>
                            <form action="{{ route('admin.user.destroy', $user->id) }}" id="deleteUserForm"
                                method="post">@csrf @method('delete')
                                <button class="btn btn-danger" id="deleteUserBtn"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>


    @push('scripts')
        <script>
            $(document).ready(function() {

                $(document).on('click', '#deleteUserBtn', function(e) {
                    e.preventDefault();
                    var con = confirm("Are you sure you want to delete this user?");

                    if (con === true) {
                        $('#deleteUserForm').submit();
                    } else if (con === false) {
                        return false;
                    }
                });
            });
        </script>
    @endpush

</x-front-layout>
