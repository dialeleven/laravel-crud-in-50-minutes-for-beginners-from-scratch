<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Support\Facades\Log;


/*
Ref:
https://mailtrap.io/blog/laravel-send-email-gmail/
https://laracasts.com/discuss/channels/laravel/adding-multiple-attachments-in-one-email
*/
class MyTestEmail extends Mailable
{
   use Queueable, SerializesModels;

   public $name;
   public $email_attachments;

   /**
    * Create a new message instance.
    */
   public function __construct($name, $email_attachments  = [])
   {
      $this->name = $name;
      $this->email_attachments = $email_attachments;
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
   public function attachments1(): array
   {
      if ($this->attachment) {
         return [$this->attachment];
         return [
            Attachment::fromPath($this->attachment),
         ];
      }

      return [];
   }


   public function attachments(): array
   {
      $attachments = [];

      if (!empty($this->email_attachments)) {
         foreach ($this->email_attachments as $email_attachment)
         {
            $file_path = storage_path('app/public/' . $email_attachment);

            if (file_exists($file_path)) {
                $attachments[] = Attachment::fromPath($file_path);
                /*
                $attachments[] = Attachment::fromPath($file_path)
                    ->as($email_attachment["file_name"])
                    ->withMime($email_attachment["mime_type"]);
                */
            } else {
                // Optionally, log a warning or handle the missing file case
                Log::warning("File not found: $file_path");
            }
         }
      }
      //and a bit of code cleanup
      return $attachments;
   }
}
