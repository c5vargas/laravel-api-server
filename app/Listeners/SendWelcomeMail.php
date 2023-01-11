<?php

namespace App\Listeners;

use App\Events\UserSignedUp;
use App\Mail\WelcomeMailAuto;
use Illuminate\Support\Facades\Mail;

class SendWelcomeMail
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
     * @param  \App\Events\UserSignedUp  $event
     * @return void
     */
    public function handle(UserSignedUp $event)
    {
        $user = $event->user;

        Mail::to($user)->send(new WelcomeMailAuto($user));
    }
}
