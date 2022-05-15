<?php
$error = array();
require "mailer.php";

if (!$con = mysqli_connect("localhost", "root", "", "student_engagement_portal_db")) {
    die("could not connect");
}

//something is posted
if (count($_POST) > 0) {
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];

    send_email($email);
}



function send_email($email)
{
    $email = addslashes($email);
    $subject = $_POST['subject'];
    $content = $_POST['content'];

    send_email($email, $subject, $content);
//    $subject = 'Reminder - Lesson/Lab incomplete';
//    $content = 'Dear student,\n
//
//According to your Moodle records, there are items outstanding due to be completed. Please ensure you address these items before class.
//
//Please note that each week of live classes relies directly on the Moodle content labelled for that ';
//
//
//    //send email here
//    send_mail($email, 'Reminder - Lesson/Lab incomplete', 'Dear student,
//
//According to your Moodle records, there are items outstanding due to be completed. Please ensure you address these items before class.
//
//Please note that each week of live classes relies directly on the Moodle content labelled for that ');
}
?>



<form method="post" action="">
    <h5>Enter emails</h5>

    <input class="textbox" type="email" name="email" placeholder="Email"><br>
    <input class="textbox" type="subject" name="subject" placeholder="Subject"><br>
    <textarea class="textbox" type="content" name="content" placeholder="Content"></textarea>

    <br style="clear: both;">
    <input type="submit" value="Send Email">
    <br><br>
</form>
