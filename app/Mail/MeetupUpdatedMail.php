<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MeetupUpdatedMail extends Mailable
{
    public $meetup;
    public $messageText;

    public function __construct($meetup, $messageText)
    {
        $this->meetup = $meetup;
        $this->messageText = $messageText;
    }

    public function build()
    {
        return $this->subject('Meetup Update')
            ->view('emails.meetup_updated');
    }
}

