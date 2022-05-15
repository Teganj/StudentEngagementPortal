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

        $_SESSION['module_name'] = $module_name;

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body" style="padding-bottom: 100px;">
                        <h1 class="box-title" style="margin-bottom: 20px">Module Engagement Dashboard
                            for: <?php echo $module_name; ?></h1>
                        <?php
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($res)) {
                            ?>
                            <div>
                                <?php
                                echo "<h4 class='box-link'><a href='user_manage_modules.php?id=" . $row['id'] . "'>Update Module</a></h4>";
                                ?>
                            </div>
                        <?php } ?>
                        <p>
                            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#barchart" aria-expanded="false" aria-controls="collapseExample">
                                Bar Chart of Activity Completion
                            </button>
                            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#piechart" aria-expanded="false" aria-controls="collapseExample">
                                Pie Chart of Activity Completion
                            </button>
                            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#areachart" aria-expanded="false" aria-controls="collapseExample">
                                Area Chart Activity Completion
                            </button>
                        </p>
                        <div class="collapse" id="barchart">
                            <div class="card card-body">
                                <?php include 'bar_chart.php' ?>
                            </div>
                        </div>
                        <div class="collapse" id="piechart">
                            <div class="card card-body">
                                <?php include 'pie_chart.php' ?>
                            </div>
                        </div>
                        <div class="collapse" id="areachart">
                            <div class="card card-body">
                                <?php include 'area_chart.php' ?>
                            </div>
                        </div>
                        <?php include 'email_students.php' ?>
                        <div class="row col-lg-12" style="width:1400px; overflow-x:auto; padding: 20px;">
                            <button id="viewToggle1" style="cursor: pointer;">Toggle EasyView</button>
                            <button id="viewToggle2" style="display: none; cursor: pointer;">Toggle EasyView</button>
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
                                $result = $con->query("SELECT * FROM reports where module_name='$module_name'");
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


<!--                        <div class="row col-lg-12" style="overflow-x:auto; padding: 20px; margin: auto;">-->
<!--                            <button id="viewToggle1" style="cursor: pointer;">Toggle EasyView</button>-->
<!--                            <button id="viewToggle2" style="display: none; cursor: pointer;">Toggle EasyView</button>-->
<!--                            --><?php
//                            $result_table = $con->query("SELECT * FROM reports where module_name='$module_name'");
//                            $result_header = $con->query("SELECT * FROM reports limit 1");
//
//                            $result_countHeader = $con->query("SELECT SUM(CASE WHEN activity1 IS NOT NULL THEN 0 ELSE 1 END
//                                                                  + CASE WHEN activity2 IS NOT NULL THEN 0 ELSE 1 END
//                                                                  + CASE WHEN activity3 IS NOT NULL THEN 0 ELSE 1 END
//                                                                  + CASE WHEN activity4 IS NOT NULL THEN 0 ELSE 1 END
//                                                                  + CASE WHEN activity5 IS NOT NULL THEN 0 ELSE 1 END
//                                                                  + CASE WHEN activity6 IS NOT NULL THEN 0 ELSE 1 END
//                                                                  + CASE WHEN activity7 IS NOT NULL THEN 0 ELSE 1 END
//                                                                  + CASE WHEN activity8 IS NOT NULL THEN 0 ELSE 1 END
//                                                                  + CASE WHEN activity9 IS NOT NULL THEN 0 ELSE 1 END
//                                                                  + CASE WHEN activity10 IS NOT NULL THEN 0 ELSE 1 END
//                                                                  + CASE WHEN activity11 IS NOT NULL THEN 0 ELSE 1 END
//                                                                  + CASE WHEN activity12 IS NOT NULL THEN 0 ELSE 1  END
//                                                                  + CASE WHEN activity13 IS NOT NULL THEN 0 ELSE 1 END
//                                                                  + CASE WHEN activity14 IS NOT NULL THEN 0 ELSE 1 END
//                                                                  + CASE WHEN activity15 IS NOT NULL THEN 0 ELSE 1 END
//                                                                  + CASE WHEN activity16 IS NOT NULL THEN 0 ELSE 1 END
//                                                                  + CASE WHEN activity17 IS NOT NULL THEN 0 ELSE 1 END
//                                                                  + CASE WHEN activity18 IS NOT NULL THEN 0 ELSE 1 END
//                                                                  + CASE WHEN activity19 IS NOT NULL THEN 0 ELSE 1 END
//                                                                  + CASE WHEN activity20 IS NOT NULL THEN 0 ELSE 1 END
//                                                                  + CASE WHEN activity21 IS NOT NULL THEN 0 ELSE 1 END
//                                                                  + CASE WHEN activity22 IS NOT NULL THEN 0 ELSE 1 END
//                                                                  + CASE WHEN activity23 IS NOT NULL THEN 0 ELSE 1 END
//                                                                  + CASE WHEN activity24 IS NOT NULL THEN 0 ELSE 1 END
//                                                                  + CASE WHEN activity25 IS NOT NULL THEN 0 ELSE 1 END) AS TotalNullCount FROM reports LIMIT 1");
//
//                            $result_countHeader = $con->query("SELECT * FROM reports LIMIT 1");
//                            ?>
<!--                            <table class="table table-striped table-bordered">-->
<!--                                <thead class="thead-dark">-->
<!--                                <tr>-->
<!--                                    --><?php
//                                    if ($result_table->num_rows > 0) {
//                                    while ($row = $result_table->fetch_assoc()) {
//                                        ?>
<!--                                        <td>--><?php //echo $row['name']; ?><!--</td>-->
<!--                                    --><?php //}
//                                    ?>
<!--                                </tr>-->
<!--                                </thead>-->
<!--                                --><?php
//                                while ($row = $result_table->fetch_assoc()) {
//                                    ?>
<!--                                    <tr>-->
<!--                                        <td>--><?php //echo $row['name']; ?><!--</td>-->
<!--                                        <td>--><?php //echo $row['activity1']; ?><!--</td>-->
<!--                                        <td>--><?php //echo $row['activity2']; ?><!--</td>-->
<!--                                        <td>--><?php //echo $row['activity3']; ?><!--</td>-->
<!--                                        <td>--><?php //echo $row['activity4']; ?><!--</td>-->
<!--                                        <td>--><?php //echo $row['activity5']; ?><!--</td>-->
<!--                                        <td>--><?php //echo $row['activity6']; ?><!--</td>-->
<!--                                        <td>--><?php //echo $row['activity7']; ?><!--</td>-->
<!--                                        <td>--><?php //echo $row['activity8']; ?><!--</td>-->
<!--                                        <td>--><?php //echo $row['activity9']; ?><!--</td>-->
<!--                                        <td>--><?php //echo $row['activity10']; ?><!--</td>-->
<!--                                        <td>--><?php //echo $row['activity11']; ?><!--</td>-->
<!--                                        <td>--><?php //echo $row['activity12']; ?><!--</td>-->
<!--                                    </tr>-->
<!--                                --><?php //}
//                                } else { ?>
<!--                                    <tr>-->
<!--                                        <td colspan="5">No data found...</td>-->
<!--                                    </tr>-->
<!--                                --><?php //}
//                                ?>
<!--                                </tbody>-->
<!--                            </table>-->
<!--                        </div>                        -->



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#viewToggle1").click(function () {
        $("td:contains('Not')").css('backgroundColor', '#ffc6c4');
        $("td:contains('Completed')").css('backgroundColor', '#bfee90');
        $("#viewToggle1").hide();
        $("#viewToggle2").show();
    });
    $("#viewToggle2").click(function () {
        $("td:contains('Not')").css('backgroundColor', '#ffffff');
        $("td:contains('Completed')").css('backgroundColor', '#ffffff');
        $("#viewToggle2").hide();
        $("#viewToggle1").show();
    });
</script>
