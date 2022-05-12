<?php
include_once 'connection.php';
$error = array();
require "mailer.php";


$sql = "SELECT * FROM `courses`";
$all_courses = mysqli_query($con,$sql);

$module_email = "";
$email_list = mysqli_query($con,$sql);

function send_student_email($email)
{
    global $con;
    // the message
    $email = addslashes($email);
    $msg = "Dear student,\nAccording to your Moodle records, there are items outstanding 
           due to be completed.\nPlease ensure you address these items before class. \n
           Please note that each week of live classes relies directly on the Moodle content 
           labelled for that week, and therefore it is easy to get left behind in class if 
           you do not keep up on Moodle\nIf you need help catching up, please reach out and 
           speak to Computing Support as soon as possible. Their email is computingsupport@ncirl.ie.
           They will be happy to help you catch up.\nKind regards,\nOnline Learning Support Team";

    // use wordwrap() if lines are longer than 70 characters
    $msg = wordwrap($msg, 70);

    // send email
    send_mail($row['email'], "Reminder - Incomplete Lesson/Lab", $msg);

    echo 'Email Sent.';

}

?>

<style>
    tr:nth-child(even) {
        background-color: rgba(150, 212, 212, 0.4);
    }

    th:nth-child(even), td:nth-child(even) {
        background-color: rgba(150, 212, 212, 0.4);
    }
</style>

<div class="card-body--">
    <h1 class="box-title">Email Students</h1>

    <div class="table-stats order-table ov-h">
        <table class="table " style="height: 250px; overflow-x:auto; width: 40%; float: left;">
            <thead>
            <tr>
                <th width="20%">Student Name</th>
                <th width="10%">Email</th>
            </tr>
            </thead>
            <tbody>
            <?php
            // Get rows
            $result = $con->query("SELECT * FROM reports where module_id='$id' ORDER BY id DESC");
            if ($result->num_rows > 0) {
                $i=1;
                while($row=mysqli_fetch_assoc($res)){?>
                    <tr>
                        <td><?php echo $row['name']?></td>
                        <td>
                            <button type="submit" value="Next"onclick="send_student_email()">Email</button>
                        </td>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <td colspan="5">No student(s) found...</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>