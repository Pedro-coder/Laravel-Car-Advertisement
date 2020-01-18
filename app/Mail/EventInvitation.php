<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Traits\MailTrait;

class EventInvitation extends Mailable
{
    use Queueable, SerializesModels, MailTrait;

    public $event;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($event)
    {
        $this->event = $event;
        $this->initMailConfig();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('email.event_invitation');
        return $this->from('matulprojectpushernew@gmail.com')
        ->view('email.event_invitation');

    }
}
