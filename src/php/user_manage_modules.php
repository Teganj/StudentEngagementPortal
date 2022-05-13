<?php
require('top.inc.php');
include("connection.php");
include("check_login.php");
include("check_reports.php");

$user_data = check_login($con);

isAdmin();
$msg = '';
$module_name = '';
$course = '';
$user_id = $user_data['id'];
$sql = "SELECT * FROM `courses`";
$all_courses = mysqli_query($con, $sql);

if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "select * from modules where id='$id'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($res);
        $module_name = $row['module_name'];
    } else {
        header('location:modules.php');
        die();
    }
}

if (isset($_POST['submit'])) {
    $module_name = get_safe_value($con, $_POST['module_name']);
    $course = get_safe_value($con, $_POST['course']);
    $res = mysqli_query($con, "select * from modules where module_name='$module_name'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getData = mysqli_fetch_assoc($res);
            if ($id == $getData['id']) {

            } else {
                $msg = "Module Already Exists 1";
            }
        } else {
            $msg = "Module Already Exists 2";
        }
    }

    if ($msg == '') {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            mysqli_query($con, "update modules set user_id='$user_id', course='$course', module_name='$module_name', uploaded_on='NOW()' where id='$id'");

            $allowTypes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
            if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $allowTypes)) {
                if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                    $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
                    fgetcsv($csvFile);

                    while (($line = fgetcsv($csvFile)) !== FALSE) {
                        $user_id = $user_data['id'];
                        $name = $line[0];
                        $email = $line[1];
                        //hardcoding completion elements wont work,need to count them from db first, then loop
                        $activity1 = $line[2];
                        $activity2 = $line[3];
                        $activity3 = $line[4];
                        $activity4 = $line[5];
                        $activity5 = $line[6];
                        $activity6 = $line[7];
                        $activity7 = $line[8];
                        $activity8 = $line[9];
                        $activity9 = $line[10];
                        $activity10 = $line[11];
                        $activity11 = $line[12];
                        $activity12 = $line[13];
                        mysqli_query($con, "UPDATE reports set user_id='$user_id', module_name='$module_name', name='$name', email='$email', activity1='$activity1', activity2='$activity2', activity3='$activity3', activity4='$activity4', activity5='$activity5', activity6='$activity6' , activity7='$activity7', activity8='$activity8', activity9='$activity9', activity10='$activity10', activity11='$activity11', activity12='$activity12'");
                    }
                    fclose($csvFile);
                    $msg = 'Module Imported Successfully';
                } else {
                    $msg = 'An Error has occurred, please try again.';
                }
            } else {
                $msg = 'Please Upload a CSV file.';
            }
        } else {
            mysqli_query($con, "INSERT INTO modules(user_id, course, module_name, uploaded_on, status) VALUES ('" . $user_id . "', '" . $course . "', '" . $module_name . "', NOW(), 1)");

            $allowTypes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
            if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $allowTypes)) {
                if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                    $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
                    fgetcsv($csvFile);

                    while (($line = fgetcsv($csvFile)) !== FALSE) {
                        $user_id = $user_data['id'];
                        $name = $line[0];
                        $email = $line[1];
                        //hardcoding completion elements wont work,need to count them from db first, then loop
                        $activity1 = $line[2];
                        $activity2 = $line[3];
                        $activity3 = $line[4];
                        $activity4 = $line[5];
                        $activity5 = $line[6];
                        $activity6 = $line[7];
                        $activity7 = $line[8];
                        $activity8 = $line[9];
                        $activity9 = $line[10];
                        $activity10 = $line[11];
                        $activity11 = $line[12];
                        $activity12 = $line[13];
                        mysqli_query($con, "INSERT INTO reports (user_id,  module_name, name, email, activity1, activity2, activity3, activity4, activity5, activity6 , activity7, activity8, activity9, activity10, activity11, activity12) VALUES ('" . $user_id . "', '" . $module_name . "', '" . $name . "', '" . $email . "', '" . $activity1 . "','" . $activity2 . "','" . $activity3 . "' , '" . $activity4 . "','" . $activity5 . "','" . $activity6 . "', '" . $activity7 . "','" . $activity8 . "','" . $activity9 . "' , '" . $activity10 . "','" . $activity11 . "','" . $activity12 . "')");
                    }
                    fclose($csvFile);
                    $msg = 'Module Imported Successfully';
                } else {
                    $msg = 'An Error has occurred, please try again.';
                }
            } else {
                $msg = 'Please Upload a CSV file.';
            }
        }
        header('location:index.php');
        die();
    }
}
?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>MODULE FORM</strong><small> </small></div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="card-body card-block">
                            <div class="form-group">
                                <label for="module_name" class=" form-control-label">Module Name</label>
                                <input type="text" name="module_name" placeholder="Enter Module Name"
                                       class="form-control" required value="<?php echo $module_name ?>">
                            </div>
                            <div class="form-group">
                                <label for="course" class=" form-control-label">Course ID</label>
                                <select class="form-control" name="course" required>
                                    <option value=''>Select</option>
                                    <?php
                                    while ($courses = mysqli_fetch_array(
                                        $all_courses, MYSQLI_ASSOC)):;
                                        ?>
                                        <option value="<?php echo $courses["course_name"]; ?>">
                                            <?php echo $courses["course_name"]; ?>
                                        </option>
                                    <?php
                                    endwhile;
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="file" name="file"/>
                            </div>
                            <button id="payment-button" name="submit" type="submit"
                                    class="btn btn-lg btn-info btn-block">
                                <span id="payment-button-amount">SUBMIT</span>
                            </button>
                            <div class="field_error"><?php echo $msg ?></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
