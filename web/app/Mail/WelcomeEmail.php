<?php

namespace App\Mail;

use Illuminate\Mail\Mailables\Address;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $message;
    public $subject;
    public $fromemail;
    public $toEmail;
    public $name;


    /**
     * Create a new message instance.
     */
    public function __construct($msg,$subject,$toEmail,$fromemail,$name)
    {
       
        $this->msg = $msg;
        $this->subject = $subject;
        $this->fromemail = $fromemail;
        $this->toEmail = $toEmail;
        $this->name = $name;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
         
        return new Envelope(
            from: new Address($this->toEmail, $this->toEmail),
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email',
            with: ['msg'=> $this->msg,'name'=>$this->name],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
