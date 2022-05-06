<?php
include_once 'connection.php';
include_once("check_login.php");
$statusMsg = '';

// File upload path
$targetDir = "../uploads/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

if (isset($_POST['importSubmit']) && !empty($_FILES["file"]["name"])) {
    //Allow types
    $csvMimes = array('csv', 'xlsx', 'text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream',
        'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexel', 'text/plain');

    //Validating if file is CSV
    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)) {
        //If file is uploaded
        if (is_uploaded_file($_FILES['file']['tmp_name'])) {

            //Open uploaded CSV
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

            //Skip first Row
            fgetcsv($csvFile);

            //Parsing data file by line
            //print this out with boxes
            while (($line = fgetcsv($csvFile)) !== FALSE) {
                // Get row data
                $id = 1;//will need to be changed later
                $name = $line[0];
                $email = $line[1];
                $activity1 = $line[3];//hardcoding completion elements wont work,need to count them from db first, then loop
                $activity2 = $line[4];
                $activity3 = $line[5];
                //while loop to count rows that are not null or columns - new table for completit


                //Check if course exist in DB with email
                $prevQuery = "SELECT id FROM reports WHERE email = '" . $line[1] . "'";
                $prevResult = $con->query($prevQuery);

                $con->query("INSERT INTO reports (name, email, activity1, activity2, activity3) VALUES ('" . $name . "', '" . $email . "', '" . $activity1 . "', '" . $activity2 . "', '" . $activity3 . "')");
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
                    $statusForm = 0;
                    $statusMsgForm = 'Something went wrong! Please try again after some time.';
                    if(isset($_POST['model_submit'])){
                        //Get submitted data
                        $course_name = $_POST['module_name'];

                        //Check if Data is empty
                        if(!empty($course_name) && !empty($module_name)){
                                $htmlContent = '<h2>Module Information Submitted</h2>
                                <h4>Course Name</h4><p>'.$course_name.'</p>
                                <h4>Module Name</h4><p>'.$module_name.'</p>';
                            $course_name = $_POST['course_name'];
                            $module_name = $_POST['module_name'];
                            $con->query("UPDATE into uploads (course_name, module_name) VALUES ('" . $course_name . "', '" . $module_name . "' ");
                        }else{
                            $statusMsg = 'Please fill in all the mandatory Fields.';
                        }
                    }

                    $reponse = array(
                        'status' => $statusForm,
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
if ($user_data['role'] === 'admin') {
    header("Location: admin_index.php" . $qstring);
    die;
} else {
    header("Location: index.php" . $qstring);
    die;
}

?>


<div id="modalDialog" class="modal">
    <div class="modal-content animate-top">
        <div class="modal-header">
            <h5 class="modal-title">Module Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"></span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" id="moduleInfo">
                <label for="course_name">Choose Course:</label><br>
                <select id="course_name" name="course_name">
                    <option value="certcomp">Certificate in Computing</option>
                    <option value="hdipcomp">HDip in Computing</option>
                    <option value="hdipda">HDip in Data Analytics</option>
                    <option value="hdipwd">HDip in Web Design</option>
                    <option value="hdipcs">HDip in Cyber Security</option>
                    <option value="msccs">MSC in Cyber Security</option>
                    <option value="mscda">MSC in Data Analytics</option>
                </select>

                <br>
                <label><b>Enter Module Name:</b></label>
                <input id="text" type="text" name="module_name"
                       placeholder="Module Name eg. Software Development Jan22"><br><br>

                <button id="button" type="submit" value="dashboard.php">Create Module</button>
            </form>
        </div>
        <div class="modal-footer">

        </div>
    </div>
</div>


<script>
    $(document).ready(function(){
        $('#moduleInfo').submit(function(e){
            e.preventDefault();
            $('.modal-body').css('opacity', '0.5');
            $('.btn').prop('disabled', true);

            $form = $(this);
            $.ajax({
                type: "POST",
                url: 'modelInformationForm.php',
                data: 'model_submit=1$'+$form.serialize(),
                dataType: 'json',
                sucess: function(response){
                    if(response.status == 1){
                        $('#moduleInfo')[0].reset();
                        $('.response').html('<div class="alert alert-success">'+response.message+'</div>');
                    }else{
                        $('.response').html('<div class="alert alert-danger">'+response.message+'</div>');
                    }
                    $('.modal-body').css('opacity', '');
                    $('.btn').prop('disabled', false);
                }
            })
        });
    });

    //Get Modal

    var modal = $('#modalDialog');

    //Get open button
    var btn = $("#mbtn");


    //Get span to close modal
    var span = $(".close");

    //Open Modal
    $(document).ready(function () {
        btn.on('click', function () {
            modal.show();
        });

        //Close Modal
        span.on('click', function () {
            modal.hide();
        });
    });
    //close if user clicks outside the modal
    $('body').bind('click', function (e) {
        if ($(e.target).hasClass("modal")) {
            modal.hide();
        }
    });
</script>