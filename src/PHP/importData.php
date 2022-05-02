<?php
include_once 'connection.php';

if(isset($_POST['importSubmit'])){
    //Allow types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream',
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
                    $con->query("INSERT INTO reports (name, email, created, week1, week2, week3, week4, week5, week6) VALUES ('".$name."', '".$email."', '".$created."', '".$week1."', '".$week2."', '".$week3."', '".$week4."', '".$week5."', '".$week6."')");
                }
            }

            //closed CSV
            fclose($csvFile);

            $qstring = '?status=succ';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

header("Location: index.php".$qstring);

?>