<x-front-layout>
    <section id="content">
        <h6>Role and Permission</h6>
        <hr>

        <table id="authorizationTable" data-toggle="table" data-show-export="true" data-buttons-prefix="btn-sm btn"
            data-buttons-align="right">
            <thead>
                <tr>
                    <th data-field="role" data-sortable="true">Role</th>
                    <th data-field="permissions" data-sortable="false">Permissions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($roles as $role) : ?>
                <tr>
                    <td>{{ $role->name }}</td>
                    <td>
                        <div class="row col-md-12">
                            @foreach ($role->permissions as $permission)
                                <div class="col-md-4 font-weight-bold">{{ $permission->title }}</div>
                            @endforeach
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</x-front-layout>
