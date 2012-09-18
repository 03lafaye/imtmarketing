<?php

require_once('recaptchalib.php');

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$recaptcha = $_POST['recaptcha_response_field'];

$privatekey = "6LfznNYSAAAAAMXcMJxTTFw_Zq9T1Dp2RTewYc1N";

$resp = recaptcha_check_answer ($privatekey,
  $_SERVER["REMOTE_ADDR"],
  $_POST["recaptcha_challenge_field"],
  $_POST["recaptcha_response_field"]);

if (!$resp->is_valid) {
?>
  <script language="javascript" type="text/javascript">
    alert('The submitted ReCAPTCHA words were incorrect. Please try again.');
    window.location = 'contactus.html';
  </script>
<?php
  exit();
} else if ($name == "" || $email == "" || $message == "") {
?>
  <script language="javascript" type="text/javascript">
    alert('Name, email, and message are all required fields. Please fill them all in before submitting.');
    window.location = 'contactus.html';
  </script>
<?php
  exit();
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
?>
  <script language="javascript" type="text/javascript">
    alert('The email address entered was invalid. Please re-enter your email.');
    window.location = 'contactus.html';
  </script>
<?php
  exit();
}

$mail_to = 'info@imtmarketing.com';
$subject = 'Message from a site visitor '.$name;

$body_message = 'From: '.$name."\n\n";
$body_message .= 'E-mail: '.$email."\n\n";
$body_message .= 'Message: '.$message;

$headers = 'From: '.$mail_to."\r\n";
$headers .= 'Reply-To: '.$email."\r\n";

$mail_status = mail($mail_to, $subject, $body_message, $headers);

if ($mail_status) { ?>
  <script language="javascript" type="text/javascript">
    alert('Thank you for your message. We will contact you shortly :)');
    window.location = 'contactus.html';
  </script>
<?php
}
else { ?>
  <script language="javascript" type="text/javascript">
    alert('Something went wrong with our email system. Please, send your email to info@imtmarketing.com');
    window.location = 'contactus.html';
  </script>
<?php
}

?>
