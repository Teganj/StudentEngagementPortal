<?php
session_start();
include("connection.php");
include("check_login.php");
$user_data = check_login($con);


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
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/dashboard_style.css">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <script type="text/javascript" scr="../javascript/dashboard.js"></script>
    <style>
        table{
            border: 1px solid;
            border-collapse: collapse;
            padding: 10px;

        }
        td,td,tr{
            border: 1px solid;
        }
    </style>
</head>
<body>
<?php include 'navbar.php' ?>
<body>
<h2>Module Engagement Dashboard</h2>

<div class="container">
    <div class="row" style="width: 100%">
            <h5> Select Module</h5>
            <select id="module" onchange="selectModule()">
                <?php while ($rows = mysqli_fetch_array($res)) {
                    ?>
                    <option value="<?php echo $rows['module_name']; ?> ">  <?php echo $rows['module_name']; ?> </option>
                    <?php
                }
                ?>
            </select>
        <table>
            <thead>
            <th>Student Name</th>
            <th>Email</th>
            <th>Week 1</th>
            <th>Week 2</th>
            <th>Week 3</th>
            <th>Week 4</th>
            <th>Week 5</th>
            <th>Week 6</th>
            </thead>
            <tbody id="ans">
            </tbody>
        </table>
    </div>
</div>




<div class="container">
    <!-- Display status message -->
    <?php if(!empty($statusMsg)){ ?>
        <div class="col-xs-12">
            <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
        </div>
    <?php } ?>

    <div class="row">
        <div class="col-8-md">
        <!-- Import link -->
        <div class="col-md-12 head">
            <div class="float-right">
                <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i> Import</a>
            </div>
        </div>
        <!-- CSV file upload form -->
        <div class="col-md-12" id="importFrm" style="display: none;">
            <form action="importData.php" method="post" enctype="multipart/form-data">
                <input type="file" name="file" />
                <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
            </form>
        </div>

        <!-- Data list table -->
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>#ID</th>
                <th>Name</th>
                <th>Activity 1</th>
                <th>Activity 2</th>
                <th>Activity 3</th>
            </tr>
            </thead>
            <tbody>
            <?php
            // Get rows
            $result = $con->query("SELECT * FROM reports ORDER BY id DESC");
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['week1']; ?></td>
                        <td><?php echo $row['week2']; ?></td>
                        <td><?php echo $row['week3']; ?></td>
                    </tr>
                <?php }
            }else{ ?>
                <tr><td colspan="5">No member(s) found...</td></tr>
            <?php }
            //lazily getting counts of each completed activity, realistically a loop should be used here
            $result2=$con->query("SELECT count(*) as total from reports where week1='Completed'");
            $a1=$result2->fetch_assoc();
            //echo $a1['total'];
            //echo "<br>";
            $result2=$con->query("SELECT count(*) as total from reports where week2='Completed'");
            $a2=$result2->fetch_assoc();
            //echo $data['total'];
            //echo "<br>";
            $result2=$con->query("SELECT count(*) as total from reports where week3='Completed'");
            $a3=$result2->fetch_assoc();
            //echo $data['total'];
            //echo "<br>";
            $result2=$con->query("SELECT count(*) as total from reports where week1='Not completed'");
            $ai1=$result2->fetch_assoc();
            $result2=$con->query("SELECT count(*) as total from reports where week2='Not completed'");
            $ai2=$result2->fetch_assoc();
            $result2=$con->query("SELECT count(*) as total from reports where week3='Not completed'");
            $ai3=$result2->fetch_assoc();
            $result2 = $con->query("SELECT COUNT(*) FROM reports where week1='completed'");
            if($result->num_rows > 0){
                ?>
                <figure class="highcharts-figure">
                    <div id="container"></div>
                </figure>
                <?php
            }
            else{ ?>
                No Data exists!!
            <?php }
            ?>
            </tbody>
        </table>
        <script>
            Highcharts.chart('container', {
                chart: {
                    type: 'bar'
                },
                title: {
                    text: 'Activities by completion'
                },
                subtitle: {
                    text: 'Indicates problem activities'
                },
                xAxis: {
                    categories: ['Activity 1', 'Activity 2', 'Activity 3'],
                    title: {
                        text: null
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Completion (lessons)',
                        align: 'high'
                    },
                    labels: {
                        overflow: 'justify'
                    }
                },
                tooltip: {
                    valueSuffix: ' lessons'
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            enabled: true
                        }
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'top',
                    x: -40,
                    y: 80,
                    floating: true,
                    borderWidth: 1,
                    backgroundColor:
                        Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
                    shadow: true
                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'Completed',
                    data: [<?php echo $a1['total']?>, <?php echo $a2['total']?>, <?php echo $a3['total']?>]
                }, {
                    name: 'Incomplete',
                    data: [<?php echo $ai1['total']?>, <?php echo $ai2['total']?>, <?php echo $ai3['total']?>]
                }]
            });
        </script>
    </div>
        <div>
            <?php include 'email_students.php' ?>
        </div>
</div>
</div>
<!-- Show/hide CSV upload form -->
<script>
    function formToggle(ID){
        var element = document.getElementById(ID);
        if(element.style.display === "none"){
            element.style.display = "block";
        }else{
            element.style.display = "none";
        }
    }
</script>

</body>
</html>