<?php
include_once 'connection.php';
include_once("check_login.php");
$statusMsg = '';

//File upload path
$targetDir = "../uploads/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

if (isset($_POST["addToUpload"]) && !empty($_FILES["file"]["name"])) {

    $allowTypes = array('csv', 'xlsx', 'text/x-comma-separated-values', 'text/comma-separated-values', 'text/csv');

         if (in_array($fileType, $allowTypes)) {
             //Upload File to Server & Save name in DB table
             if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                 // Insert file name into database
                 $course_name = $_POST['course_name'];
                 $module_name = $_POST['module_name'];

                 $insert = $con->query("INSERT into uploads (file_name, course_name, module_name, uploaded_on) VALUES ('" . $fileName . "', '" . $course_name . "', '" . $module_name . "', NOW())");
                 if ($insert) {
                     $statusMsg = "The file " . $fileName . " has been uploaded successfully.";

                     if($user_data['role'] === 'admin') {
                         header("Location: admin_index.php" . $qstring);
                         die;
                     } else {
                         header("Location: dashboard.php" . $qstring);
                         die;
                     }

                 } else {
                     $statusMsg = "File upload failed, please try again.";
                 }
             } else {
                 $statusMsg = "Sorry, there was an error uploading your file.";
             }
         } else {
             $statusMsg = 'Sorry, only CSV or xlsx files are allowed to upload.';
         }
} else {
    $statusMsg = 'Please select a file to upload.';
}

// Display status message
echo $statusMsg;
?>
