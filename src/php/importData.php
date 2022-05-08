<?php
session_start();
include("connection.php");
include("check_login.php");

$user_data = check_login($con);

//File upload path
$targetDir = "../uploads/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
$statusMsg = '';


if (isset($_POST['addToUpload']) && !empty($_FILES["file"]["name"]) && !empty($_POST['course_name']) && !empty($_POST['module_name'])) {

    //Allowed types
    $allowTypes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

    //Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $allowTypes)){

        //If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){

            //Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

            //Skip the first line
            fgetcsv($csvFile);

            //Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE) {
                // Get row data
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


//                //Check whether Module already exists in the database with the same Name
//                $prevQuery = "SELECT * FROM reports WHERE module_name = '". $_POST['module_name']."'";
//                $prevResult = $con->query($prevQuery);
//
//                if ($prevResult->num_rows > 0) {
//                    //Update module data in the database
//                    $con->query("UPDATE reports SET name = '" . $name . "', email = '" . $email . "', activity1 = '" . $activity1 . "', activity2 = '" . $activity2 . "', activity3 = '" . $activity3 . "', activity4 = '" . $activity4 . "', activity5 = '" . $activity5 . "', activity6 = '" . $activity6 . "', activity7 = '" . $activity7 . "', activity8 = '" . $activity8 . "', activity9 = '" . $activity9 . "', activity10 = '" . $activity10 . "', activity11 = '" . $activity11 . "', activity12 = '" . $activity12 . "'  WHERE email = '" . $module_name . "'");
//                } else {
                    //Insert module data in the database
                    $con->query("INSERT INTO reports (user_id, course_name, module_name, name, email, activity1, activity2, activity3 , activity4, activity5, activity6 , activity7, activity8, activity9 , activity10, activity11, activity12) VALUES ('" . $user_id . "', '" . $course_name . "', '" . $module_name . "', '" . $name . "', '" . $email . "', '" . $activity1 . "','" . $activity2 . "','" . $activity3 . "' , '" . $activity4 . "','" . $activity5 . "','" . $activity6 . "', '" . $activity7 . "','" . $activity8 . "','" . $activity9 . "' , '" . $activity10 . "','" . $activity11 . "','" . $activity12 . "' )");
//                }
            }

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

            // Close opened CSV file
            fclose($csvFile);

            $qstring = '?status=succ';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

// Redirect to the listing page
if($user_data['role'] === 'admin') {
    header("Location: admin_index.php" . $qstring);
    die;
} else {
    header("Location: dashboard.php" . $qstring);
    die;
}
?>