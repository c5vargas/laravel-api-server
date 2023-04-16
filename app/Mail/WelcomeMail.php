<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Setting;
use Carbon\Carbon;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $toUser;
    public $fromUser;
    public $appName;
    public $appLogo;
    public $password;
    public $actualDate;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($toUser, $fromUser, $password)
    {
        $this->appName = config('app.name');
        $this->appLogo = config('app.logo');
        $this->password = $password;
        $this->toUser = $toUser;
        $this->fromUser = $fromUser;
        $this->actualDate = Carbon::now()->toFormattedDateString();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->fromUser->email)
            ->view('emails.welcome')
            ->subject( __('mail.welcome.subject', ['name' => $this->appName]) );
    }
}
