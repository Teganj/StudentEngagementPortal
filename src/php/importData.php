<?php
include("connection.php");
include("check_login.php");

$user_data = check_login($con);

//File upload path
$targetDir = "../uploads/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
isAdmin();
$module_name = '';
$module_id = '';
$course = '';
$user_id = $user_data['id'];
$msg = '';


if (isset($_POST['addToUpload']) && !empty($_FILES["file"]["name"]) && !empty($_POST['course_name']) && !empty($_POST['module_name'])) {

    //Allowed types
    $allowTypes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

    //Validate whether selected file is a CSV file
    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $allowTypes)) {

        //If the file is uploaded
        if (is_uploaded_file($_FILES['file']['tmp_name'])) {

            //Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

            //Skip the first line
            fgetcsv($csvFile);

            //Parse data from CSV file line by line
            while (($line = fgetcsv($csvFile)) !== FALSE) {
                // Get row data
                $upload_id = 1;
                $user_id = $user_data['id'];
                $course_name = $_POST['course_name'];
                $module_name = $_POST['module_name'];
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

                $con->query("INSERT INTO reports (upload_id, user_id, course_name, module_name, name, email, activity1, activity2, activity3 , activity4, activity5, activity6 , activity7, activity8, activity9 , activity10, activity11, activity12) VALUES ('" . $upload_id . "', '" . $user_id . "', '" . $course_name . "', '" . $module_name . "', '" . $name . "', '" . $email . "', '" . $activity1 . "','" . $activity2 . "','" . $activity3 . "' , '" . $activity4 . "','" . $activity5 . "','" . $activity6 . "', '" . $activity7 . "','" . $activity8 . "','" . $activity9 . "' , '" . $activity10 . "','" . $activity11 . "','" . $activity12 . "' )");
            }

            //Upload File to Server & Save name in DB table
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                // Insert file name into database
                $course_name = $_POST['course_name'];
                $module_name = $_POST['module_name'];
                $user_id = $user_data['id'];

                $con->query("INSERT into uploads (user_id, file_name, course_name, module_name, uploaded_on) VALUES ('" . $user_id . "', '" . $fileName . "', '" . $course_name . "', '" . $module_name . "', NOW())");

            } else {
                $msg = 'An Error has occurred, please try again.';
            }

            // Close opened CSV file
            fclose($csvFile);

            $msg = 'Module Imported Successfully';
        } else {
            $msg = 'An Error has occurred, please try again.';
        }
    } else {
        $msg = 'Please Upload a CSV file.';
    }

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
    $module_name = get_safe_value($con, $_POST['module_name']);
    $module_id = get_safe_value($con, $_POST['module_id']);

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
            mysqli_query($con, "update modules set user_id='$user_id', course='$course', module_name='$module_name', module_id='$module_id' where id='$id'");
        } else {
            mysqli_query($con, "INSERT INTO modules(user_id, course, module_name, module_id, status) VALUES ('" . $user_id . "', '" . $course . "', '" . $module_name . "', '" . $module_id . "', 1)");
        }
        header('location:addModule.php');
        die();

    }
}
//
//// Redirect to the listing page
//if($user_data['role'] === 'admin') {
//    header("Location: admin/admin_index.php");
//    die;
//} else {
//    header("Location: viewModule.php");
//    die;
//}
?>