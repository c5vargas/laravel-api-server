<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WantResetPassword
{
    use Dispatchable, SerializesModels;

    /**
     * @property App\Models\User
     */
    public $user;
    public $token;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, String $token)
    {
        $this->user = $user;
        $this->token = $token;
    }
}
