@component('mail::message')
# Feedback on {{$feedback->Event->name}}

The event got feedback from our visitors.

@component('mail::button', ['url' => ''])
View
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
