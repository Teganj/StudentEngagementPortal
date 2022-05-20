<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

$subject = $_POST['subject'];
$email = $_POST['emails'];
$message = $_POST['message'];
$smtp = new SMTPMailerEmails();
$mail = $smtp->load();

foreach (explode(",", $email) as $address) {

    //call phpmailerlibrary class here
    $mail->addAddress($address, "Hello");
    $mail->Subject = $subject;
    $mail->Body = $message;
    if ($mail->send()) {
        echo "success";
    } else {
        echo $mail->ErrorInfo;
    }
}


?>

