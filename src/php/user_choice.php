<?php
session_start();
include("connection.php");
include("check_login.php");
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
</head>
<body>
<?php include 'navbar.php' ?>

<div class="container">
    <!--    <h2>Welcome, --><?php //echo $user_data['name']; ?><!--! </h2>-->
    <h2>Please choose an option below! </h2>
    <div class="row">

        <div class="card" style="width: 18rem; float: left">
            <div class="w3-container w3-center w3-animate-left">
                <img class="card-img-top w3-circle" src="../img/viewModulesImg.jpg" alt="View Modules">
                <div class="card-body">
                    <a href="dashboard.php" class="btn btn-primary"><h5 class="card-title">View Module</h5></a>
                </div>
            </div>
        </div>

        <div class="card" style="width: 18rem; float: right;">
            <div class="w3-container w3-center w3-animate-right">
                <img class="card-img-top w3-circle" src="../img/addModuleImg.jpg" alt="Add a Module">
                <div class="card-body">
                    <a href="index.php" class="btn btn-primary"><h5 class="card-title">Add a Module</h5></a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>