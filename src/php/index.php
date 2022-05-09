<?php
session_start();
include("connection.php");
include("check_login.php");
require('top.inc.php');

$user_data = check_login($con);
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Student Engagement Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <style>
        #addModuleImg{
            background-image: url("../img/viewModulesImg.jpg");
            position: relative;
            background-size: cover;
        }
        #viewModuleImg{
            background-image: url("../img/addModuleImg.jpg");
            position: relative;
            background-size: cover;
        }

    </style>
</head>
<body>
<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body--">
                        <h1 style="text-align: center; font-weight: bold; margin: auto; padding-top: 50px;">Welcome, <?php echo $user_data['name']; ?> <br> Please choose an option below!</h1>

                        <div class="container"style="padding-bottom: 100px;">
                            <div class="row" style="padding-top: 50px;">

                                <div class="card" id="addModuleImg" style="width: 40%; float: left; border: 5px solid #784794; padding: 10%; margin: auto;">
                                    <div class="w3-container w3-center w3-animate-left">
                                        <div class="card-body">
                                            <a href="viewModuleChoice.php" class="btn btn-primary"><h5 class="card-title">View Module</h5></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="card" id="viewModuleImg" style="width: 40%; float: right; border: 5px solid #784794; padding: 10%; margin: auto;">
                                    <div class="w3-container w3-center w3-animate-right">
                                        <div class="card-body">
                                            <a href="addModule.php" class="btn btn-primary"><h5 class="card-title">Add a Module</h5></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
