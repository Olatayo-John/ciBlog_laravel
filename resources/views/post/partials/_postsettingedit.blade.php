@foreach(config('site.postSettings') as $key => $settingsArray)
	<div class="form-group">
		<label>{{$settingsArray['title']}}</label>

		@if($settingsArray['is_array'] === true)
			<select class="form-control" name="{{$settingsArray['meta_key']}}" required>
				<option value="">Select</option>
				@foreach($settingsArray['meta_value'] as $settingsOptions)
					<option {{($settingsOptions === $postsettings[$key]['meta_value']) ? 'selected' : ''}}>
					{{$settingsOptions}}
					</option>
				@endforeach
			</select>
		@else
			<input type="text" name="{{$settingsArray['meta_key']}}" value="{{}}" class="form-control">
		@endif
	</div>
@endforeach