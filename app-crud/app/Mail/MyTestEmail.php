<?php


namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
Use Illuminate\Mail\Mailables\Attachment;


class MyTestEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $attachment;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $attachment = null)
    {
        $this->name = $name;
        $this->attachment = $attachment;
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'My Test Email from ' . $_SERVER['HTTP_HOST'],
        );
    }


    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            // view: 'email.test-email', // plain text email
            view: 'email.test-html-email', // html email
            with: [
                'name' => $this->name
            ],
        );
    }


    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        if ($this->attachment) {
            return [$this->attachment];
            return [
                Attachment::fromPath($this->attachment),
            ];
        }

        return [];
    }
}
