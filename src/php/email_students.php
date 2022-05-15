<?php
$error = array();
require "mailer.php";

$module_name = $_SESSION['module_name'];
$sql = "SELECT * FROM reports where module_name='$module_name'";
$allStudents = mysqli_query($con, $sql);

if (!$con = mysqli_connect("localhost", "root", "", "student_engagement_portal_db")) {
    die("could not connect");
}

//something is posted
if (count($_POST) > 0) {
    $email = $_POST['email'];
    send_email($email);
}

function send_email($email){
    $email = addslashes($email);

    $subject = 'Reminder - Lesson/Lab incomplete';
    $content = 'Dear Student,
                According to your Moodle records, there are items outstanding to be completed for: ' . $_SESSION['module_name'] . '. Please ensure you address these items before class.
                Please let me know if I can be of assistance in any way; I am happy to answer any questions you may have. 
                Please note that each week of live classes relies directly on the Moodle content labelled for that week, and therefore it is easy to get left behind in class if you do not keep up on Moodle. 
                If you need help catching up, please reach out and speak to Computing Support as soon as possible. Their email is computingsupport@ncirl.ie. They will be happy to help you catch up. 
                If you feel you have received this message in error, please let me know. 
                Kind regards, 
                Online Learning Support';

    //send email here
    send_mail($email, $subject, $content);
}
?>



<form method="post" action="">
<!--    <input class="textbox" type="email" name="email" placeholder="Email"><br>-->
<!--        <br style="display: none;">-->


    <label for="email" class=" form-control-label">Choose Student to Email</label>
    <select class="form-control" type="email" name="email" required>
        <option value=''>Select</option>
        <?php
        while ($students = mysqli_fetch_array(
            $allStudents, MYSQLI_ASSOC)):;
            ?>
            <option value="<?php echo $students["email"]; ?>">
                <?php echo $students["name"]; ?>
            </option>
        <?php
        endwhile;
        ?>
    </select>

    <input type="submit" value="Send Email">
    <br><br>
</form>
