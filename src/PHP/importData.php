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
            while(($line = fgetcsv($csvFile)) !== FALSE){
                //Get Data rows
                $name = $line[0];
                $email = $line[1];
                $week1 = $line[2];
                $week2 = $line[3];
                $week3 = $line[4];
                $week4 = $line[5];
                $week5 = $line[6];
                $week6 = $line[7];

                //Check if members exist in DB with email
                $prevQuery = "SELECT id FROM reports WHERE email = '".$line[1]."'";
                $prevResult = $con->query($prevQuery);

                if($prevResult-> num_rows > 0){
                    //Updating member data
                    $con->query("UPDATE reports SET name = '".$name."'");
                }else{
                    //Insert data into DB
                    $con->query("INSERT INTO reports (name, email, week1, week2, week3, week4, week5, week6) VALUES ('".$name."', '".$email."', '".$week1."', '".$week2."', '".$week3."', '".$week4."', '".$week5."', '".$week6."')");
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

header("Location: index.php".$qstring);

?>