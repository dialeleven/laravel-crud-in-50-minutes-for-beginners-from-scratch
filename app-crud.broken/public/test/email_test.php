<?php
$to_email = "getfrancistsao@gmail.com";
$from_email = 'getfrancistsao@gmail.com';
$subject = "Simple Email Test via PHP";
$body = "Hi,\n\n This is test email send by PHP Script";
$headers = "From: $from_email\r\n" .
           "Reply-To: $from_email\r\n" .
           'X-Mailer: PHP/' . phpversion();
 
if (mail($to_email, $subject, $body, $headers)) {
    echo "REGULAR PHP+sendmail: Email successfully sent to $to_email... " . date('Y-m-d H:i:s');
} else {
    echo "Email sending failed... " . date('Y-m-d H:i:s');
}