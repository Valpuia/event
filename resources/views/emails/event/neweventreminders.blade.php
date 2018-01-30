@component('mail::message')
# Dear Registrar,
### Reminder for new Event

The Event have been organised and booked by {{$event->User->department_id}} Department on {{$event->date}}

Details of the Event:
@component('mail::panel')
	![Event Image](http://localhost:8000/images/{{$event->image}})<br>
@endcomponent
@component('mail::panel')
	Details 	| 
	-------		| ---------------
	Name:		| {{$event->name}}
	Place:		| {{$event->location_id}}
	Date:		| {{$event->date}}
	Hosted By:		| {{$event->User->department_id}}
	About:		| {!! nl2br(e($event->description)) !!}
@endcomponent

@component('mail::button', ['url' => 'http://localhost:8000/event/'.$event->id])
View Event
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
