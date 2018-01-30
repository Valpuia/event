@component('mail::message')
# Hello, {{$user->name}}.
### AIMS Event welcomes you to the website

*You received this mail because you're **added as faculty** on our website*

Use this credentials to get access.
@component('mail::panel')
	Email: {{$user->email}}<br>
	Password: {{$password}}
@endcomponent

You can visit the website by clicking this button

@component('mail::button', ['url' => 'http://localhost:8000'])
View AIMS Event
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
