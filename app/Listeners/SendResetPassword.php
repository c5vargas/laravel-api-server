<?php

namespace App\Listeners;

use App\Events\WantResetPassword;
use App\Mail\ForgetPassword;
use Illuminate\Support\Facades\Mail;

class SendResetPassword
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
    public function handle(WantResetPassword $event)
    {
        $user = $event->user;
        $token = $event->token;

        Mail::to($user)->send(new ForgetPassword($user, $token));
    }
}
