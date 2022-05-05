<?php
include_once 'connection.php';
$error = array();
require "mailer.php";

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


<div class="row" style="width: 100%; padding: 10px">
    <h2>Email Students</h2>
    <!-- Data list table -->
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
        <tr>
            <th>Name</th>
            <th>Email</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Get rows
        $result = $con->query("SELECT * FROM reports ORDER BY id DESC");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td>
                        <button onclick="send_student_email()">Email</button>
                    </td>
                </tr>
            <?php }
        } else { ?>
            <tr>
                <td colspan="5">No student(s) found...</td>
            </tr>
        <?php }
        ?>
        </tbody>
    </table>
</div>