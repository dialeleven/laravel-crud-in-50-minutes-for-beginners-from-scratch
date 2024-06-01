<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; // email functionality?

use App\Mail\MyTestEmail; // email functionality?


class EmailController extends Controller
{
   // Send email using Laravel and Gmail SMTP
   // Ref: https://mailtrap.io/blog/laravel-send-email-gmail/#How-to-send-emails-using-Laravel-and-Gmail-SMTP
   public function sendEmail()
   {
      $name = "Funny Coder";

      $to_email = env('MAIL_FROM_ADDRESS'); //'username@gmail.com';
   
      // The email sending is done using the to method on the Mail facade
      $val = Mail::to($to_email)->send(new MyTestEmail($name = 'Jon Doe'));
   
      return "<b>Email sent to $to_email!</b><h1>" . date('Y-m-d H:i:s') . '</h1>';
   }


   public function sendEmailWithAttachment()
   {
      $name = "Funny Coder";
      $filePath = [
                     'images/20240507_023639000000_twice_between1&2.jpg', 
                     'images/20240507_025420000000_twice_group.jpg'
                  ];

      $to_email = env('MAIL_FROM_ADDRESS'); //'username@gmail.com';

      // The email sending is done using the to method on the Mail facade
      // Mail::to($to_email)->send(new MyTestEmail($name));
      Mail::to($to_email)->send(new MyTestEmail($name, $filePath));

      return "<b>Email sent to <span style='color: blue'>$to_email</span>!</b><h1>" . date('Y-m-d H:i:s') . '</h1>';
   }


   public function sendEmailWithCcBcc()
   {
      $main_recipient_email = env('MAIL_FROM_ADDRESS');

      $mainRecipients = [$main_recipient_email, 'main2@example.com'];
      #$ccRecipients = ['cc1@example.com', 'cc2@example.com'];
      $ccRecipients = '';
      $bccRecipients = ['username@gmail.com', 'username@gmail.com'];
      $name = "Funny Coder"; // Dynamic content
      /*
      Mail::to($mainRecipients)
         ->cc($ccRecipients)
         ->bcc($bccRecipients)
         ->send(new MyTestEmail($name));
      */
      Mail::bcc($bccRecipients)
         ->send(new MyTestEmail($name));
      
      print_r($bccRecipients);
      return "<b>Email sent!</b><h1>" . date('Y-m-d H:i:s') . '</h1>';
   }
}
