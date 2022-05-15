<?php

use PHPMailer\PHPMailer\PHPMailer;

class SMTPMailerEmails
{
    public function load()
    {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->isHTML(TRUE);
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;
        $mail->Host = "smtp.gmail.com";
        $mail->Username = "teganjennings580@gmail.com";
        $mail->Password = "kbdugsdcficqxieh";
        $mail->CharSet = "utf-8";
        $mail->From = "teganjennings580@gmail.com";
        $mail->FromName = "Online Learning Support";
        return $mail;
    }
}
?>

