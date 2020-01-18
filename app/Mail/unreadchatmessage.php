<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Traits\MailTrait;

use App\User;
use App\Message;

class unreadchatmessage extends Mailable
{
    use Queueable, SerializesModels, MailTrait;

    public $msg;

    public function __construct(Message $message)
    {
       $this->msg=$message;
       $this->initMailConfig();
    }

    // public function __construct()
    // {
        
    // }

   
    public function build()
    {
        return $this->from('matulprojectpushernew@gmail.com')
                    ->view('email.toClient');
    }
}
