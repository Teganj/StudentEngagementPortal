<?php
$user_data = check_login($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Engagement Portal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-icon-top navbar-expand-lg" style="background-color: #784794;">
    <a class="navbar-brand" href="index.php" style="color: white; font-weight: bold;">Student Engagement</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php" style="color: white; ">
                    <i class="fa fa-home"></i>Home<span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="dashboard.php" id="navbarDropdown" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
                    <i class="fa fa-envelope-o"><span class="badge badge-primary">3</span></i>Modules
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="dashboard.php">HDipC_IntroToDatabases</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="dashboard.php">HDipC_SoftwareDev</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="dashboard.php">HDipC_Multimedia</a>
                </div>
            </li>
            <li class="nav-item active form-inline my-2 my-lg-0 float-right">
                <a class="nav-link" href="logout.php" style="color: white; ">
                    <i class="fa fa-home"></i>
                    Logout
                    <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item active form-inline my-2 my-lg-0 float-right">
                <a class="nav-link" href="index.php" style="color: white; ">
                    <h4>Welcome <?php echo $user_data['name']; ?> </h4>
                </a>
            </li>
        </ul>
    </div>
</nav>
</body>
</html>
