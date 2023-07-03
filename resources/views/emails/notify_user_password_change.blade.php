<x-mail::message>
<strong>#Password Change</strong>

<x-mail::panel>
	Hi {{$name}}, this is to notify you that your password has been changed.
</x-mail::panel>

Thanks,<br>
{{ config('app.name') }}

</x-mail::message>