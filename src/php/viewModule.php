<?php
require('top.inc.php');
include("connection.php");
include("check_login.php");

$user_data = check_login($con);

isAdmin();
$module_name = '';
$module_id = '';
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
        header('location:viewModule.php');
        die();
    }
}

if (isset($_POST['submit'])) {
    $module_name = get_safe_value($con, $_POST['module_name']);
    $module_id = get_safe_value($con, $_POST['module_id']);

    $res = mysqli_query($con, "select * from modules where module_name='$module_name'");
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
            mysqli_query($con, "update modules set user_id='$user_id', course='$course', module_name='$module_name', module_id='$module_id' where id='$id'");
        } else {
            mysqli_query($con, "INSERT INTO modules(user_id, course, module_name, module_id, status) VALUES ('" . $user_id . "', '" . $course . "', '" . $module_name . "', '" . $module_id . "', 1)");
        }
        header('location:viewModule.php');
        die();
    }
}
?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong><h3>Module Engagement Dashboard</h3></strong><small></small></div>
                        <div class="row content" style="width: 100%;">
                            <div class="col-sm-3 sidenav vl">
                                <div>
                                    <h3>Update the CSV here!</h3><br>
                                    <input type="file" name="file"/><br>
                                    <input value="Update Module" id="button" style="margin-top: 10px; width: 50%;"
                                           type="submit" value="dashboard.php"
                                           name="addToUpload">

                                    <!-- Display status message -->
                                    <?php if (!empty($statusMsg)) { ?>
                                        <div class="col-xs-12">
                                            <div class="alert <?php echo $statusMsg; ?>"><?php echo $statusMsg; ?></div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <?php include 'email_students.php' ?>
                            </div>
                            <div class="col-sm-9" style="padding-top: 20px; border: black solid 3px">
                                <?php include 'pie_chart.php' ?>
                            </div>
                        </div>
                    <div style="padding:20px;">
                        <div class="row col-lg-12" style="border: black solid 3px; margin: auto;">
                            <?php include 'bar_chart.php' ?>
                        </div>
                    </div>

                    <div class="row col-lg-12" style="overflow-x:auto; padding: 20px; margin: auto;">
                        <!-- Data list table -->
                        <table class="table table-striped table-bordered">
                            <thead class="thead-dark">
                            <tr>
                                <th>Name</th>
                                <th>Activity 1</th>
                                <th>Activity 2</th>
                                <th>Activity 3</th>
                                <th>Activity 4</th>
                                <th>Activity 5</th>
                                <th>Activity 6</th>
                                <th>Activity 7</th>
                                <th>Activity 8</th>
                                <th>Activity 9</th>
                                <th>Activity 10</th>
                                <th>Activity 11</th>
                                <th>Activity 12</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            // Get rows loops
                            $result = $con->query("SELECT * FROM reports ORDER BY module_id DESC");
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['activity1']; ?></td>
                                        <td><?php echo $row['activity2']; ?></td>
                                        <td><?php echo $row['activity3']; ?></td>
                                        <td><?php echo $row['activity4']; ?></td>
                                        <td><?php echo $row['activity5']; ?></td>
                                        <td><?php echo $row['activity6']; ?></td>
                                        <td><?php echo $row['activity7']; ?></td>
                                        <td><?php echo $row['activity8']; ?></td>
                                        <td><?php echo $row['activity9']; ?></td>
                                        <td><?php echo $row['activity10']; ?></td>
                                        <td><?php echo $row['activity11']; ?></td>
                                        <td><?php echo $row['activity12']; ?></td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="5">No data found...</td>
                                </tr>
                            <?php }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
