<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Traits\MailTrait;

use App\User;

class verifymail extends Mailable
{
    use Queueable, SerializesModels, MailTrait;

    public $user;
    public function __construct(User $user)
    {
        $this->user=$user;
        $this->initMailConfig();
    }
   

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('matulprojectpushernew@gmail.com')
                    ->view('email.verifyemail');
       
    }
}
