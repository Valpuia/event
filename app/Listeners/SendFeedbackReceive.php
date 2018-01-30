<?php

namespace App\Listeners;

use App\Events\NewFeedback;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\NewFeedbackReceive;
use Mail;

class SendFeedbackReceive
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
     * @param  NewFeedback  $event
     * @return void
     */
    public function handle(NewFeedback $event)
    {
        Mail::to('admin@admin.in')->send(new NewFeedbackReceive($event->feedback));
    }
}
