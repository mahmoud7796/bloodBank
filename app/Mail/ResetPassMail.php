<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $resetPassToken;
    public $user;


    public function __construct($user,$resetPassToken)
    {
        $this->user = $user;
        $this->resetPassToken = $resetPassToken;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $resetPassToken= $this->resetPassToken;
        $user = $this->user;
        return $this->subject('Mail from BloodBankApp')
            ->view('users.auth.resetPassEmailNotification',compact('user','resetPassToken'));
    }
}
