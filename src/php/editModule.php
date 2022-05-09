<?php
require('top.inc.php');
include("connection.php");
include("check_login.php");

$user_data = check_login($con);


$module_name = '';
$course = '';
$user_id = $user_data['id'];

$msg='';
if(isset($_GET['id']) && $_GET['id']!=''){
    $image_required='';
    $id=get_safe_value($con,$_GET['id']);
    $res=mysqli_query($con,"select * from modules where id='$id'");
    $check=mysqli_num_rows($res);
    if($check>0){
        $row=mysqli_fetch_assoc($res);
        $module_name = $row['module_name'];
        $coupon_type=$row['course_id'];
    }else{
        header('location:index.php');
        die();
    }
}
$sql = "SELECT * FROM `courses`";
$all_courses = mysqli_query($con,$sql);
if(isset($_POST['submit'])){
    $module_name = get_safe_value($con, $_POST['module_name']);
    $course_id=get_safe_value($con,$_POST['course_id']);

    $res=mysqli_query($con,"select * from modules where module_name='$module_name'");
    $check=mysqli_num_rows($res);
    if($check>0){
        if(isset($_GET['id']) && $_GET['id']!=''){
            $getData=mysqli_fetch_assoc($res);
            if($id==$getData['id']){

            }else{
                $msg="Module Already Exists 1";
            }
        }else{
            $msg="Module Already Exists 2";
        }
    }


    if($msg==''){
        if(isset($_GET['id']) && $_GET['id']!=''){
            mysqli_query($con, "update modules set user_id='$user_id', course_id='$course_id', module_name='$module_name' where id='$id'");
        }else{
            mysqli_query($con, "INSERT INTO modules(user_id, course_id, module_name, status) VALUES ('" . $user_id . "', '" . $course . "', '" . $module_name . "', 1)");
        }
        header('location:index.php');
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
                                    <label for="module_name" class=" form-control-label">Module Name</label>
                                    <input type="text" name="module_name" placeholder="Enter Module Name" class="form-control" required value="<?php echo $module_name?>">
                                </div>
                                <div class="form-group">
                                    <label for="course_id" class=" form-control-label">Course ID</label>
                                    <select class="form-control" name="course_id" required>
                                        <option value=''>Select</option>
                                        <?php
                                        while ($courses = mysqli_fetch_array(
                                            $all_courses,MYSQLI_ASSOC)):;
                                            ?>
                                            <option value="<?php echo $courses["id"];
                                            ?>">
                                                <?php echo $courses["course_name"];
                                                ?>
                                            </option>
                                        <?php
                                        endwhile;
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <input type="file" name="file"/>
                                </div>


                                <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">SUBMIT</span>
                                </button>
                                <div class="field_error"><?php echo $msg?></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>