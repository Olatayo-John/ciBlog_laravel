<x-front-layout>
    <section id="content">
        <h6>Settings</h6>

        <form method="post" action="{{ route('usersetting.update', auth()->user()->id) }}" class="col-md-12">
            @csrf
            @method('put')

            @foreach (config('site.userSettings') as $key => $settingsArray)
                <div class="form-group">
                    <label>{{ $settingsArray['title'] }}</label>

                    @if ($settingsArray['is_array'] === true)
                        <select class="form-control" name="{{ $settingsArray['meta_key'] }}" required>
                            <option value="">Select</option>
                            @foreach ($settingsArray['meta_value'] as $settingsOptions)
                                <option {{ $settingsOptions === $mysettings[$key]['meta_value'] ? 'selected' : '' }}>
                                    {{ $settingsOptions }}
                                </option>
                            @endforeach
                        </select>
                    @else
                        <input type="text" name="{{ $settingsArray['meta_key'] }}" value="{{}}"
                            class="form-control" required>
                    @endif
                </div>
            @endforeach


            <div class="form-group">
                <button class="btn btn-secondary" type="subbmit">Save</button>
            </div>
        </form>

    </section>
</x-front-layout>
