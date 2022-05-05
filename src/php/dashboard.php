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

    <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/dashboard_style.css">

    <script type="text/javascript" scr="../javascript/dashboard.js"></script>
    <script>
        window.onload = function () {
            var dataPoints = [];
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                exportEnabled: true,
                title: {
                    text: "Tuna Production"
                },
                axisY: {
                    title: "In metric tons"
                },
                data: [{
                    type: "column",
                    toolTipContent: "{y} metric tons",
                    dataPoints: dataPoints
                }]
            });
            $.get("https://canvasjs.com/data/gallery/php/tuna-production.csv", getDataPointsFromCSV);

            //CSV Format
            // Year,Volume
            function getDataPointsFromCSV(csv) {
                var csvLines = points = [];
                csvLines = csv.split(/[\r?\n|\r|\n]+/);
                for (var i = 0; i < csvLines.length; i++) {
                    if (csvLines[i].length > 0) {
                        points = csvLines[i].split(",");
                        dataPoints.push({
                            label: points[0],
                            y: parseFloat(points[1])
                        });
                    }
                }
                chart.render();
            }
        }
    </script>

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
            <th>Week 7</th>
            <th>Week 8</th>
            <th>Week 9</th>
            <th>Week 10</th>
            <th>Week 11</th>
            <th>Week 12</th>

            </thead>
            <tbody id="ans">

            </tbody>
        </table>
    </div>
</div>
<div id="chartContainer" style="height: 370px; width: 45%;"></div>
<h2>Email Students</h2>
<div class="container">
    <div class="row" style="width: 100%">
        <div class="column" style="width: 50%">
            <ul style="list-style: none; width: 100%;">
                <li><h3>Luke Byrne</h3>
                    <button class="emailbtn" onClick="alert('Emailed')">Email</button>
                </li>
                <li><h3>April Chow</h3>
                    <button class="emailbtn" onClick="alert('Emailed')">Email</button>
                </li>
                <li><h3>Eoghan Dempsey</h3>
                    <button class="emailbtn" onClick="alert('Emailed')">Email</button>
                </li>
                <li><h3>Amanda Dunne</h3>
                    <button class="emailbtn" onClick="alert('Emailed')">Email</button>
                </li>
                <li><h3>David Fitzgerald</h3>
                    <button class="emailbtn" onClick="alert('Emailed')">Email</button>
                </li>
            </ul>
        </div>
        <div class="column" style="width: 50%">
            <ul style="list-style: none; width: 100%; float: right">
                <li><h3>Declan Kennedy</h3>
                    <button class="emailbtn" onClick="alert('Emailed')">Email</button>
                </li>
                <li><h3>John Mcbride</h3>
                    <button class="emailbtn" onClick="alert('Emailed')">Email</button>
                </li>
                <li><h3>Mark Mccarthy</h3>
                    <button class="emailbtn" onClick="alert('Emailed')">Email</button>
                </li>
                <li><h3>Padraig Mccarthy</h3>
                    <button class="emailbtn" onClick="alert('Emailed')">Email</button>
                </li>
                <li><h3>Sara Moore</h3>
                    <button class="emailbtn" onClick="alert('Emailed')">Email</button>
                </li>
            </ul>
        </div>
    </div>
</div>

</body>
</html>