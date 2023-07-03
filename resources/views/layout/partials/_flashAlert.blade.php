@if (session()->has('message'))
    <div class="flashMsg">
        <strong>{{ session('message') }}</strong>
    </div>
@endif

@if (session()->has('flashMsg'))
    <div class="flashMsg">
        <strong>{{ session('flashMsg.msg') }}</strong>
    </div>
@endif

@if (session('status') == 'verification-link-sent')
    <div class="flashMsg">
        <strong>A new verification link has been sent to the email address you provided during
            registration.</strong>
    </div>
@endif

@if (session('status'))
    <div class="flashMsg">
        <strong>{{ session('status') }}.</strong>
    </div>
@endif
