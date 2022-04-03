<?php

namespace App\Jobs;

use App\Mail\ResetPassMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ResetPassJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $resetPassToken;
    public $user;

    public function __construct($user,$resetPassToken)
    {
        $this->user= $user;
        $this->resetPassToken= $resetPassToken;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->resetPassToken->email)->send(new ResetPassMail($this->user,$this->resetPassToken));

    }
}
