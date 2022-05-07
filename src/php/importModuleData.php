<?php
session_start();
include("connection.php");
include("check_login.php");

$user_data = check_login($con);
$statusMsg = '';

//File upload path
$targetDir = "../uploads/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

if (isset($_POST["addToUpload"]) && !empty($_FILES["file"]["name"]) && !empty($_POST['course_name']) && !empty($_POST['module_name'])) {

    $allowTypes = array('csv', 'xlsx', 'text/x-comma-separated-values', 'text/comma-separated-values', 'text/csv');

         if (in_array($fileType, $allowTypes)) {
             //Upload File to Server & Save name in DB table
             if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                 // Insert file name into database
                 $course_name = $_POST['course_name'];
                 $module_name = $_POST['module_name'];
                 $user_id = $user_data['id'];

                 $insert = $con->query("INSERT into uploads (user_id, file_name, course_name, module_name, uploaded_on) VALUES ('" . $user_id . "', '" . $fileName . "', '" . $course_name . "', '" . $module_name . "', NOW())");

                 if ($insert) {
                     $qstring = '?status=succ';
                     if($user_data['role'] === 'admin') {
                         header("Location: admin_index.php" . $qstring);
                         die;
                     } else {
                         header("Location: dashboard.php" . $qstring);
                         die;
                     }

                 } else {
                     $qstring = '?status=err';
                 }
             } else {
                 $qstring = '?status=err';
             }

         } else {
             $qstring = '?status=invalid_file';
         }
} else {
    $qstring = '?status=err';
}
?>
