<?php

namespace App\Listeners;

use App\Events\NewEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\NewEventReminder;
use Mail;

class SendNotifyEvent
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewEvent  $event
     * @return void
     */
    public function handle(NewEvent $event)
    {
        Mail::to('registrar@example.com')->send(new NewEventReminder($event->event));
    }
}
