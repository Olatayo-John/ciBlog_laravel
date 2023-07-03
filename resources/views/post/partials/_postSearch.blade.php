<form action="{{ route('post.index') }}" method="get">

    <div class="input-group mb-3">
        <input type="text" name="search" id="search" class="form-control postSearch" value="{{ request('search') }}"
            placeholder="Search by title, description ...">
        <div class="input-group-append">
            <button type="submit" class="btn btn-secondary">Search</button>
        </div>
    </div>
</form>
