<?php

include("connection.php");
$statusMsg = '';

//File upload Dir
$targetDir = "../uploads/";

if(isset($_POST["submit"])){
    if(!empty($_FILES["file"]["name"])){
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

        //Only allow certain file types
        $allowTypes = array('csv', 'xlsx');
        if(in_array($fileType, $allowTypes)){
            //Uploading file to server
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                //Insert file to DB
                $insert = $con->query("Insert into uploads (file_name, uploaded_on) values('".$fileName."', NOW())");
                if($insert){
                    $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
                }else{
                    $statusMsg = "File upload failed, please try again.";
                }
            }else{
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        }else{
            $statusMsg = "Sorry, only CSV XLSX files are allowed up be uploaded.";
        }
    }else{
        $statusMsg = "Please select a file to upload.";
    }
}

?>