<?php
include_once 'connection.php';
require "mailer.php";
require '../PHPMailer/src/PHPMailer.php';
require_once('../PHPMailer/src/SMTP.php');
require_once('../PHPMailer/src/Exception.php');

if(isset($_POST['email_data'])){
    $output = '';
    foreach ($_POST['email_data'] as $row) {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port       = 587;
        $mail->Host       = "smtp.gmail.com";
        $mail->Username   = "teganjennings580@gmail.com";
        $mail->Password   = "kbdugsdcficqxieh";
        $mail->From   = "teganjennings@ncirl.ie";
        $mail->FromName = 'Online Learning SUpport';
        $mail->AddAddress($row["email"], $row{"name"});
        $mail->WordWrap = 50;
        $mail->IsHTML(true);
        $mail->Subject = 'Reminder Incomplete Lesson/Lab';
        $mail->Body = 'Dear Student, /n
        According to your Moodle records, there are items outstanding
           due to be completed. /nPlease ensure you address these items before class. \n
           Please note that each week of live classes relies directly on the Moodle content 
           labelled for that week, and therefore it is easy to get left behind in class if 
           you do not keep up on Moodle\nIf you need help catching up, please reach out and 
           speak to Computing Support as soon as possible. Their email is computingsupport@ncirl.ie.
           They will be happy to help you catch up.\nKind regards,\nOnline Learning Support Team
        ';


        $mail->AltBody = '';
        $result = $mail->Send();

        if($result["code"] == '400'){
            $output .= html_entity_decode($result['full_error']);
        }
    }
    if($output == ''){
        echo 'ok';
    }else{
        echo $output;
    }
}

?>