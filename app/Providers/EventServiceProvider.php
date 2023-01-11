<?php

namespace App\Providers;

use App\Events\UserSignedUp;
use App\Events\WantResetPassword;
use App\Listeners\SendResetPassword;
use App\Listeners\SendWelcomeMail;
use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserSignedUp::class => [
            SendWelcomeMail::class,
        ],
        WantResetPassword::class => [
            SendResetPassword::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
    }
}
