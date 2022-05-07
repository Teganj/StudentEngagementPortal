<?php
session_start();
include("connection.php");
include("check_login.php");

$user_data = check_login($con);

if(isset($_POST['addToUpload'])){

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
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $user_id = $user_data['id'];
                $course_name = $_POST['course_name'];
                $module_name = $_POST['module_name'];
                $name   = $line[0];
                $email 	= $line[1];
                $activity1  = $line[2];//hardcoding completion elements wont work,need to count them from db first, then loop
                $activity2  = $line[3];
                $activity3 = $line[4];

                // Insert member data in the database
                $con->query("INSERT INTO reports (user_id, course_name, module_name, name, email, activity1, activity2, activity3) VALUES ('".$user_id."', '".$course_name."', '".$module_name."', '".$name."', '".$email."', '".$activity1."','".$activity2."','".$activity3."')");
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