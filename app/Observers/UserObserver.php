<?php

namespace App\Observers;

use App\Models\User;
use App\Events\UserSignedUp;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        UserSignedUp::dispatch($user);
    }
}
