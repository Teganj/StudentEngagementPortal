<?php
include_once 'connection.php';
include_once("check_login.php");
$statusMsg = '';

//File upload path
$targetDir = "../uploads/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

if (isset($_POST['importSubmit']) && !empty($_FILES["file"]["name"])) {
    //Allow types
    $csvMimes = array('csv', 'xlsx', 'text/x-comma-separated-values', 'text/comma-separated-values', 'text/csv',
        'application/csv', 'application/excel', 'text/plain');

    //Validating if file is CSV
    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)) {
        //If file is uploaded
        if (is_uploaded_file($_FILES['file']['tmp_name'])) {

            //Open uploaded CSV
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

            //Skip first Row
            fgetcsv($csvFile);

            //Parsing data file by line
            //Check if Data is empty
            while (($line = fgetcsv($csvFile)) !== FALSE) {
                // Get row data
                $id = 1;
                $course_name = $line[0];
                $module_name = $line[1];
                $name = $line[2];
                $email = $line[3];
//                        $rowCount = "SELECT COUNT(*) FROM reports WHERE Base.name AS TotalRowCount";
                $activity1 = $line[4];
                //hardcoding completion elements wont work,need to count them from db first, then loop
                $activity2 = $line[5];
                $activity3 = $line[6];
                //while loop to count rows that are not null or columns - new table for completit


                //Check if course exist in DB with email
                $prevQuery = "SELECT * FROM reports WHERE email = '" . $line[3] . "'";
                $prevResult = $con->query($prevQuery);

                $con->query("INSERT INTO reports (course_name, module_name, name, email, activity1, activity2, activity3) VALUES ('" . $course_name . "', '" . $module_name . "', '" . $name . "', '" . $email . "', '" . $activity1 . "', '" . $activity2 . "', '" . $activity3 . "')");
            }

            //Closed CSV
            fclose($csvFile);

            $qstring = '?status=succ';

            //Upload File to Server & Save name in DB table
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                // Insert file name into database
                $insert = $con->query("INSERT into uploads (file_name, uploaded_on) VALUES ('" . $fileName . "', NOW())");
                if ($insert) {
                    $statusMsg = "The file " . $fileName . " has been uploaded successfully.";
                    //Add a popup form to get Course and Module Name
                    $statusMsgForm = 'Something went wrong! Please try again after some time.';
                    if (isset($_POST['modal_submit'])) {
                        //Get submitted data
                        $course_name = $_POST['course_name'];
                        $module_name = $_POST['module_name'];

                        if (!empty($course_name) && !empty($module_name)) {
                            $htmlContent = '<h2>Module Information Submitted</h2>
                                <h4>Course Name</h4><p>' . $course_name . '</p>
                                <h4>Module Name</h4><p>' . $module_name . '</p>';
                            $course_name = $_POST['course_name'];
                            $module_name = $_POST['module_name'];
                            $con->query("UPDATE into uploads (course_name, module_name) VALUES ('" . $course_name . "', '" . $module_name . "' ");
                        } else {
                            $statusMsg = 'Please fill in all the mandatory Fields.';
                        }
                    }
                    if($user_data['role'] === 'admin') {
                        header("Location: admin_index.php" . $qstring);
                        die;
                    } else {
                        header("Location: dashboard.php" . $qstring);
                        die;
                    }

                    $reponse = array(
                        'status' => $statusMsg,
                        'message' => $statusMsgForm
                    );
                    echo json_encode($reponse);


                } else {
                    $statusMsg = "File upload failed, please try again.";
                }
            } else {
                $statusMsg = "Sorry, there was an error uploading your file.";
            }

        } else {
            $qstring = '?status=err';
        }
    } else {
        $qstring = '?status=invalid_file';
    }
}
?>
