<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Setting;
use Carbon\Carbon;

class ForgetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $appName;
    public $appLogo;
    public $actualDate;

    public $token;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $token)
    {

        $this->appName = config('app.name');
        $this->appLogo = config('app.logo');
        $this->actualDate = Carbon::now()->toFormattedDateString();
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS', 'noreply@app.com'))
            ->view('emails.forgetpassword')
            ->subject(trans('Solicitud de restablecimiento de contraseña de :name', ['name' => $this->appName]));
    }
}
