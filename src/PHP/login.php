<?php
    session_start();
    include("connection.php");
    include("check_login.php");
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        //something was posted
        $email = $_POST['email'];
        $password = $_POST['password'];

        if(!empty($email) && !empty($password) && !is_numeric($email)){
            //read from database
            $query = "SELECT * FROM users WHERE email = '$email' limit 1";
            $result = mysqli_query($con, $query);
            if($result) {
                if($result && mysqli_num_rows($result) > 0) {
                    $user_data = mysqli_fetch_assoc($result);
                    if($user_data['password'] === $password) {
                        $_SESSION['email'] = $user_data['email'];
                        $_SESSION['role_id'] = $user_data['role_id'];
                        header("Location: index.php");
                        die;
                    }
                }
            }
            echo "wrong username or password!";
        }else {
            echo "wrong username or password!";
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../CSS/login_style.css">
        <link rel="stylesheet" href="../CSS/style.css">
        <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-icon-top navbar-expand-lg" style="background-color: #784794;">
            <a class="navbar-brand" href="#" style="color: white; font-weight: bold;">Student Engagement Portal</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>

        <h2 style="text-align: center; margin-top: 10px;">Student Retention Portal Login</h2>


        <div id="box" style="margin-top: 0px; margin-bottom: 0px;" >
            <form class="modal-content animate" method="post">
                <div class ="container" style="font-size: 20px;margin: 10px">

                <label><b>Email</b></label>
                <input id="text" type="text" name="email" placeholder="Enter Email"><br><br>

                <label><b>Password</b></label>
                <input id="text" type="password" name="password" placeholder="Enter Password"><br><br>

                    <button id="button" type="submit" value="Login">Login</button>

                <a href="forgot.php">Forgot Password?  </a><br><br>
            </form>
        </div>
        </div>
    </body>
</html>
