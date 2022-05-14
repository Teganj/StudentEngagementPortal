<?php
session_start();
include("connection.php");
include("check_login.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //something was posted
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
        //Read from database
        $query = "select * from users where user_name = '$user_name' limit 1";
        $result = mysqli_query($con, $query);
        if ($result) {
            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                if ($user_data['password'] === $password) {
                    $_SESSION['user_id'] = $user_data['user_id'];
                    if ($user_data['role'] === 'admin') {
                        header("Location: admin/index.php");
                        die;
                    } else {
                        header("Location: index.php");
                        die;
                    }
                }
            }
        }
        echo "wrong username or password!";
    } else {
        echo "wrong username or password!";
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>

<div id="bg"></div>
<div style="margin: auto;">
    <form class="modal-content animate" method="post">
        <h1 style="font-weight: bold; margin: auto; padding-top: 50px;">Student Retention Portal Login</h1>
        <hr class="rounded" style="border-top: 8px solid #47AB11; border-radius: 5px;">

        <div class="row" style="font-size: 20px;margin: 10px;">
            <h2><label><b>Username:</b></label></h2>
            <input id="text" type="text" name="user_name" placeholder="Enter Username"><br><br>


            <h2 style="padding-top: 50px;"><label><b>Password:</b></label></h2>
            <input id="text" type="password" name="password" placeholder="Enter Password"><br><br>


            <button class="btn" style="margin: auto;" id="button" type="submit" value="Login">Login</button>

            <a href="forgot.php">Forgot Password?</a><br><br>

        </div>
    </form>
</div>

</body>
</html>
