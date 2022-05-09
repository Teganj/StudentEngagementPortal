<?php
session_start();
include("connection.php");
include("check_login.php");
require('top.inc.php');

$user_data = check_login($con);

$con = mysqli_connect("localhost", "root", "", "student_engagement_portal_db");
$sql = "SELECT module_name FROM reports";
$res = mysqli_query($con, $sql);

$upload_data = "SELECT uploaded_on FROM reports";
$res1 = mysqli_query($con, $upload_data);


?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Student Engagement Portal</title>
    <script type="text/javascript" scr="../javascript/dashboard.js"></script>
    <script scr="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/dashboard_style.css">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <script type="text/javascript" scr="../javascript/dashboard.js"></script>
    <link rel="stylesheet" href="../css/pie_chart.css">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <style>
        table {
            border: 1px solid;
            border-collapse: collapse;
            padding: 10px;

        }

        td, td, tr {
            border: 1px solid;
        }

        .vl {
            border-right: 6px solid #784794;
            height: 500px;
        }

    </style>
    <!-- Display status message -->
    <?php if (!empty($statusMsg)) { ?>
        <div class="col-xs-12">
            <div class="alert <?php echo $statusMsg; ?>"><?php echo $statusMsg; ?></div>
        </div>
    <?php } ?>
</head>
<body>
<body style="padding-bottom: 50px;">


<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body--">


                        <h1 style="text-align: center; font-weight: bold; margin: auto; padding-top: 50px; padding-bottom: 50px;">
                            Module Engagement Dashboard</h1>

                        <hr class="rounded"
                            style="border-top: 8px solid #784794; border-radius: 5px; margin: auto; width: 98%">


                        <div class="container-fluid">
                            <div class="row content" style="width: 100%;">
                                <div class="col-sm-3 sidenav vl">
                                    <div class="row">
                                        <h4>Update the CSV here!</h4>
                                        <input type="file" name="file"/>
                                        <input value="Update Module" id="button" style="margin: 10px; width: 50%;"
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
                            <div class="row col-lg-12">
                                <div style="padding-top: 20px;  border: black solid 3px">
                                    <?php include 'bar_chart.php' ?>
                                </div>
                            </div>
                        </div>
                            <hr class="rounded" style="border-top: 8px solid #bbb; border-radius: 5px;">
                            <div class="col-12-md" style="overflow-x:auto; padding: 10px">
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
                                    $result = $con->query("SELECT * FROM reports ORDER BY upload_id DESC");
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
</div>



</body>
</html>