<?php
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
    }else{
        $statusMsg = 'Please fill in all the mandatory Fields.';
    }
}

$reponse = array(
    'status' => $statusForm,
    'message' => $statusMsgForm
);
echo json_encode($reponse);
