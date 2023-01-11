<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Setting;
use Carbon\Carbon;

class WelcomeMailAuto extends Mailable
{
    use Queueable, SerializesModels;

    public $toUser;
    public $appName;
    public $appLogo;
    public $actualDate;

    public $password;
    public $fromUser;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($toUser)
    {
        $this->appName = config('app.name');
        $this->appLogo = config('app.logo');
        $this->toUser = $toUser;
        $this->actualDate = Carbon::now()->toFormattedDateString();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS', 'noreply@app.com'))
            ->view('emails.welcome')
            ->subject(trans('¡Nueva cuenta en :name! Ya puede utilizar nuestra plataforma.', ['name' => $this->appName]));
    }
}
