<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public $verifyEmailToken;

    public function __construct($user,$verifyEmailToken)
    {
        $this->user = $user;
        $this->verifyEmailToken = $verifyEmailToken;

    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->user;
        $verifyEmailToken= $this->verifyEmailToken;
        return $this->subject('Mail from Oneme')
            ->view('site.auth.verifyEmail',compact('user','verifyEmailToken'));
    }
}
