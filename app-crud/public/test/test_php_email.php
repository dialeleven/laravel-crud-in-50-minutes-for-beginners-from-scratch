<?php
$to_email = "getfrancistsao@gmail.com";
$subject = "Simple Email Test via PHP from " . $_SERVER['HTTP_HOST'];
$body = "Hi,\n\n This is test email send by PHP Script from " . $_SERVER['HTTP_HOST'];
$headers = "From: getfrancistsao@gmail.com";
 
if (mail($to_email, $subject, $body, $headers)) {
    echo "Email successfully sent to $to_email... <h1>" . date("Y-m-d H:i:s") . "</h1>";
} else {
    echo "Email sending failed...";
}


$current_timezone = date_default_timezone_get();
echo "Current Timezone: " . $current_timezone;
