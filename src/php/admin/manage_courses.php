<?php
require('top.inc.php');
$course_name = '';
$course_code = '';
$msg = '';
if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "select * from courses where id='$id'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($res);
        $course_name = $row['course_name'];
    } else {
        header('location:courses.php');
        die();
    }
}

if (isset($_POST['submit']) && !empty($_POST['course_name']) && !empty($_POST['course_code'])) {
    $course_name = get_safe_value($con, $_POST['course_name']);
    $course_code = get_safe_value($con, $_POST['course_code']);

    $res = mysqli_query($con, "select * from courses where course_name='$course_name'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getData = mysqli_fetch_assoc($res);
            if ($id == $getData['id']) {

            } else {
                $msg = "Course Already Exists!";
            }
        } else {
            $msg = "Course Already Exists!";
        }
    }

    if ($msg == '') {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            mysqli_query($con, "update courses set course_name='$course_name', course_code ='$course_code' where id='$id'");
        } else {
            mysqli_query($con, "insert into courses(course_name, course_code, status) values('$course_name', '$course_code', '1')");
        }
        header('location:courses.php');
        die();
    }
}
?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>ADD COURSE</strong></div>
                    <form method="post">
                        <div class="card-body card-block">
                            <div class="form-group">
                                <label for="course_name" class=" form-control-label">Course Name</label>
                                <input type="text" name="course_name" placeholder="ENTER COURSE NAME"
                                       class="form-control" required value="<?php echo $course_name ?>"><br>
                                <label for="course_code" class=" form-control-label">Course Code</label>
                                <input type="text" name="course_code" placeholder="ENTER COURSE CODE"
                                       class="form-control" required value="<?php echo $course_code ?>">

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
