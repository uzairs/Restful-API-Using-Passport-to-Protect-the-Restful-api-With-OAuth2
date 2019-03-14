@component('mail::message')
# Hello {{$user->name}}

Thanks you for create an account.please Verify your email  using this button:


@component('mail::button', ['url' => route('verify', $user->verification_token)])
Verify Account
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent