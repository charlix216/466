<?php

//use vendor\PHPMailer\PHPMailer\PHPMailer;



class Mail{
public static function sendMail($name , $email, $start_time,$endtime, $formated_date){
  require './vendor/autoload.php';
  $msg = '';
  $mail = new PHPMailer();
  $mail->isSMTP();
  $mail->Host = 'email-smtp.us-east-1.amazonaws.com';
  $mail->CharSet = 'utf-8';
  //It's important not to use the submitter's address as the from address as it's forgery,
  //which will cause your messages to fail SPF checks.
  //Use an address in your own domain as the from address, put the submitter's address in a reply-to
  $mail->setFrom('cbautista2013@gmail.com', (empty($name) ? 'Contact form' : $name));
  $mail->addAddress($email);
  //$mail->AddCC('cbautista2013@gmail.com', 'adivisor');

  $mail->Username = 'AKIAIT62QBGRESWFXJUA';

  // Replace smtp_password with your Amazon SES SMTP password.
  $mail->Password = 'AprJxK1XJ9lNZCe644z85O5XZ+PDzlCgK/DnDbs7TzOg';
  $mail->addReplyTo($email, $name);

  $mail->Subject = 'Advising Reservation: ' ;
  $mail->Body = "Thank you   \n\n" . $name;
  $mail->Body .= "\n\n you have scheduled an appointment with an adivisor on  \n\n" . $formated_date;
  $mail->Body .= "\n\n from \n\n" . $start_time . " \n\n - \n\n" . $endtime;
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = 'tls';
  $mail->Port = 587;
  $mail->isHTML(true);


  if (!$mail->send()) {
      $msg .= "Mailer Error: " . $mail->ErrorInfo;
  } else {
      $msg .= "Message sent!";
  }


}
}

?>
