<?php
    session_start();
    include("connection.php");
    include("functions.php");
    $user_data = check_login($con);
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Student Engagement Portal</title>
        <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        <link rel="stylesheet" href="../functions.php">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="../CSS/style.css">
        <link rel="stylesheet" href="../CSS/dashboard_style.css">
        <script>
            window.onload = function () {
                var dataPoints = [];
                var chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled: true,
                    exportEnabled: true,
                    title:{
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
    </head>
    <body>
    <?php include 'navbar.php'?>
    <body>
        <h2>Module Engagement Dashboard</h2>
        <div id="chartContainer" style="height: 370px; width: 45%;"></div>
        <h2>Email Students</h2>
        <div class="container">
            <div class="row" style="width: 100%">
                <div class="column" style="width: 50%">
                    <ul style="list-style: none; width: 100%;">
                        <li><h3>Luke Byrne</h3><button class="emailbtn" onClick="alert('Emailed')">Email</button></li>
                        <li><h3>April Chow</h3><button class="emailbtn" onClick="alert('Emailed')">Email</button></li>
                        <li><h3>Eoghan Dempsey</h3><button class="emailbtn" onClick="alert('Emailed')">Email</button></li>
                        <li><h3>Amanda Dunne</h3><button class="emailbtn" onClick="alert('Emailed')">Email</button></li>
                        <li><h3>David Fitzgerald</h3><button class="emailbtn" onClick="alert('Emailed')">Email</button></li>
                    </ul>
                </div>
                <div class="column" style="width: 50%">
                    <ul style="list-style: none; width: 100%; float: right">
                        <li><h3>Declan Kennedy</h3><button class="emailbtn" onClick="alert('Emailed')">Email</button></li>
                        <li><h3>John Mcbride</h3><button class="emailbtn"onClick="alert('Emailed')">Email</button></li>
                        <li><h3>Mark Mccarthy</h3><button class="emailbtn" onClick="alert('Emailed')">Email</button></li>
                        <li><h3>Padraig Mccarthy</h3><button class="emailbtn" onClick="alert('Emailed')">Email</button></li>
                        <li><h3>Sara Moore</h3><button class="emailbtn" onClick="alert('Emailed')">Email</button></li>
                    </ul>
                </div>
            </div>
        </div>

    </body>
</html>