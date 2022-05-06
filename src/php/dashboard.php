<?php
session_start();
include("connection.php");
include("check_login.php");
$user_data = check_login($con);

$upload_data = check_login($con);


$con = mysqli_connect("localhost", "root", "", "student_engagement_portal_db");
$sql = "SELECT module_name FROM reports";
$res = mysqli_query($con, $sql);


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
</head>
<body>
<?php include 'navbar.php' ?>
<body style="padding-bottom: 50px;">
<h2>Module Engagement Dashboard</h2>

<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-3 sidenav vl">
            <div class="row">
                <h3>Update the CSV here</h3>
                <h4 style="font-weight: bold">This CSV was last updated on: <?php //echo $_GET['uploaded_on'] ?>
                    <?php //echo $uploaded_data['uploaded_on']; ?></h4>

                <?php include 'csv_upload.php' ?><br>

                <!-- Display status message -->
                <?php if (!empty($statusMsg)) { ?>
                    <div class="col-xs-12">
                        <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
                    </div>
                <?php } ?>
            </div>
            <hr class="rounded" style="border-top: 8px solid #784794; border-radius: 5px;">
            <?php include 'email_students.php' ?>
        </div>


        <div class="col-sm-9">
            <hr class="rounded" style="border-top: 8px solid #bbb; border-radius: 5px;">
            <div class="row">
                <div class="col-8-md">
                    <!-- Data list table -->
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                        <tr>
                            <th>Name</th>
                            <th>Activity 1</th>
                            <th>Activity 2</th>
                            <th>Activity 3</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        // Get rows loops
                        $result = $con->query("SELECT * FROM reports ORDER BY id DESC");
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['activity1']; ?></td>
                                    <td><?php echo $row['activity2']; ?></td>
                                    <td><?php echo $row['activity3']; ?></td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="5">No member(s) found...</td>
                            </tr>
                        <?php }
                        //lazily getting counts of each completed activity, realistically a loop should be used here
                        $result2 = $con->query("SELECT count(*) as total from reports where activity1='Completed'");
                        $a1 = $result2->fetch_assoc();
                        //echo $a1['total'];
                        //echo "<br>";
                        $result2 = $con->query("SELECT count(*) as total from reports where activity2='Completed'");
                        $a2 = $result2->fetch_assoc();
                        //echo $data['total'];
                        //echo "<br>";
                        $result2 = $con->query("SELECT count(*) as total from reports where activity3='Completed'");
                        $a3 = $result2->fetch_assoc();
                        //echo $data['total'];
                        //echo "<br>";
                        $result2 = $con->query("SELECT count(*) as total from reports where activity1='Not completed'");
                        $ai1 = $result2->fetch_assoc();
                        $result2 = $con->query("SELECT count(*) as total from reports where activity2='Not completed'");
                        $ai2 = $result2->fetch_assoc();
                        $result2 = $con->query("SELECT count(*) as total from reports where activity3='Not completed'");
                        $ai3 = $result2->fetch_assoc();
                        $result2 = $con->query("SELECT COUNT(*) FROM reports where activity1='completed'");
                        if ($result->num_rows > 0) {
                            ?>
                            <figure class="highcharts-figure">
                                <div id="container"></div>
                            </figure>
                            <?php
                        } else { ?>
                            No Data exists!!
                        <?php }
                        ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-4-sm">
                        <?php include 'pie_chart.php' ?>
                    </div>
                    <div class="col-4-sm">
                        <?php include 'bar_chart.php' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Show/hide CSV upload form -->
<script>
    function formToggle(ID) {
        var element = document.getElementById(ID);
        if (element.style.display === "none") {
            element.style.display = "block";
        } else {
            element.style.display = "none";
        }
    }
</script>

</body>
</html>