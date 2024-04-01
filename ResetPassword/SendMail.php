<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include vendor/autoload.php file/
require '../vendor/autoload.php';

// Create new PHPMailer.
$mail = new PHPMailer(true);
try {
  // Server settings.
  $mail->isSMTP();
  // Specify SMTP server.
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  // SMTP username.
  $mail->Username = 'ansarimdkaif0@gmail.com';
  // SMTP password.
  $mail->Password = 'pdfa cgcx xxox myud';
  $mail->SMTPSecure = 'tls';
  $mail->Port = 587;

  // Recipients.
  $mail->setFrom('ansarimdkaif0@gmail.com', 'No reply');
  $mail->addAddress($email);

  // Content of mail.
  $mail->isHTML(true);
  $mail->Subject = 'Reset Your Password';
  $mail->Body = 'Click <a href="http://basics-of-mysql.com/ResetPassword/ResetPassword.php?token=' . $token . '">here</a> to reset your password.';
  $mail->send();
  $resetPassMsg = 'Reset password link sent successfully!';
}
catch (Exception $e) {
  $resetPassMsg = 'Email could not be sent, please try agian.';
}
