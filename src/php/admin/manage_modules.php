<?php
require('top.inc.php');
include("../connection.php");
include("../check_login.php");

$user_data = check_login($con);

isAdmin();
$module_name = '';
$course = '';
$user_id = $user_data['id'];

$msg = '';
if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "select * from modules where id='$id'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($res);
        $module_name = $row['module_name'];
    } else {
        header('location:modules.php');
        die();
    }
}

if (isset($_POST['submit'])) {
    $module_name = get_safe_value($con, $_POST['module_name']);

    $res = mysqli_query($con, "select * from  where module_name='$module_name'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getData = mysqli_fetch_assoc($res);
            if ($id == $getData['id']) {

            } else {
                $msg = "Module Already Exists 1";
            }
        } else {
            $msg = "Module Already Exists 2";
        }
    }


    if ($msg == '') {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            mysqli_query($con, "update modules set user_id='$user_id', course_id='$course_id', module_name='$module_name' where id='$id'");
        } else {
            mysqli_query($con, "INSERT INTO modules(user_id, course_id, module_name, status) VALUES ('" . $user_id . "', '" . $course . "', '" . $module_name . "', 1)");
        }
        header('location:modules.php');
        die();
    }
}
?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>MODULE FORM</strong><small> </small></div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="card-body card-block">

                            <div class="form-group">
                                <label for="course">Choose Course:</label><br>
                                <select id="course" name="course">
                                    <option value="certcomp">Certificate in Computing</option>
                                    <option value="hdipcomp">HDip in Computing</option>
                                    <option value="hdipda">HDip in Data Analytics</option>
                                    <option value="hdipwd">HDip in Web Design</option>
                                    <option value="hdipcs">HDip in Cyber Security</option>
                                    <option value="msccs">MSC in Cyber Security</option>
                                    <option value="mscda">MSC in Data Analytics</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="module_name" class=" form-control-label">Module Name</label>
                                <input type="text" name="module_name" placeholder="Enter Module Name"
                                       class="form-control" required value="<?php echo $module_name ?>">
                            </div>

                            <div class="form-group">
                                <input type="file" name="file"/>
                            </div>

                            <button id="payment-button" name="submit" type="submit"
                                    class="btn btn-lg btn-info btn-block">
                                <span id="payment-button-amount">SUBMIT</span>
                            </button>
                            <div class="field_error"><?php echo $msg ?></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
