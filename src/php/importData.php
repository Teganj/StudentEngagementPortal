<?php
include_once 'connection.php';

$statusMsg = '';

// File upload path
$targetDir = "../uploads/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(isset($_POST['importSubmit']) && !empty($_FILES["file"]["name"])){
    //Allow types
    $csvMimes = array( 'csv', 'xlsx', 'text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream',
        'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexel', 'text/plain');

    //Validating if file is CSV
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        //If file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){

            //Open uploaded CSV
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

            //Skip first Row
            fgetcsv($csvFile);

            //Parsing data file by line
            //print this out with boxes
            while(($line = fgetcsv($csvFile)) !== FALSE){
                //Get Data rows
                $course_name = $line[0];
                $module_name = $line[1];
                $lecturer = $line[2];

                //while loop to count rows that are not null or columns - new table for completit

                $name = $line[3];
                $email = $line[4];
                $week1 = $line[5];
                $week2 = $line[6];
                $week3 = $line[7];
                $week4 = $line[8];
                $week5 = $line[9];
                $week6 = $line[10];
                $week7 = $line[11];
                $week8 = $line[12];
                $week9 = $line[13];
                $week10 = $line[14];
                $week11 = $line[15];
                $week12 = $line[16];

                //Check if course exist in DB with email
                $prevQuery = "SELECT id FROM reports WHERE email = '".$line[1]."'";
                $prevResult = $con->query($prevQuery);

                if($prevResult-> num_rows > 0){
                    //Updating member data
                    $con->query("UPDATE reports SET name = '".$name."'");
                }else{
                    //Insert data into DB
                    $con->query("INSERT INTO reports (course_name, module_name, lecturer, name, email, week1,
                        week2, week3, week4, week5, week6, week7, week8, week9, week10, week11, week12) 
                     ALUES ('".$course_name."', '".$module_name."', '".$lecturer."', '".$name."', '".$email."', '".$week1."', '".$week2."', '".$week3."', '".$week4."', '".$week5."', '".$week6."', '".$week7."', '".$week8."', '".$week9."', '".$week10."', '".$week11."', '".$week12."')");
                }

            }

            //closed CSV
            fclose($csvFile);

            $qstring = '?status=succ';

            //Upload File to Server & Save name in DB table
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                // Insert file name into database
                $insert = $con->query("INSERT into uploads (file_name, uploaded_on) VALUES ('".$fileName."', NOW())");
                if($insert){
                    $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
                }else{
                    $statusMsg = "File upload failed, please try again.";
                }
            }else{
                $statusMsg = "Sorry, there was an error uploading your file.";
            }

        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

header("Location: admin_index.php".$qstring);

?>