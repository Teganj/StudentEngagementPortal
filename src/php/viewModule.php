<?php
require('top.inc.php');
include("connection.php");
include("check_login.php");

$user_data = check_login($con);

$module_name = '';
$module_id = '';
$course = '';
$user_id = $user_data['id'];
$id = $user_data['id'];

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
                $msg = "Module Already Exists";
            }
        } else {
            $msg = "Module Already Exists";
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

<script scr="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">

<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-body" style="padding-bottom: 100px;">
                        <h1 class="box-title"  style="margin-bottom: 20px">Module Engagement Dashboard for: <?php echo $module_name; ?></h1>
                        <?php
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($res)) {
                            ?>
                            <div>
                                <?php
                                echo "<h4 class='box-link'><a href='user_manage_modules.php?id=" . $row['id'] . "'>Update Module</a></h4>
";
                                ?>
                            </div>
                        <?php } ?>
                        <div class="row col-lg-12"
                             style="margin: 20px; border: black solid 3px; background-color: #04AA6D; height: 250px;">
                            <?php include 'bar_chart.php' ?>
                        </div>

                        <div class="row col-lg-12"
                             style="margin: 20px; border: black solid 3px; background-color: #888888; height: 250px;">
                            <?php include 'pie_chart.php' ?>
                        </div>
                        <div class="row col-lg-12" style="width: 100%; margin: 20px">
                            <?php include 'email_students.php' ?>

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
                                $result = $con->query("SELECT * FROM reports");
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

