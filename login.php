<?php
session_start();
include("connection.php");
include("check_login.php");
$msg = '';

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
                    $_SESSION['user_id'] = $user_data['id'];
                    $_SESSION['name'] = $user_data['name'];
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
        $msg= "Wrong username or password!";
    } else {
        $msg=  "Please enter your username and password!";
    }
}
?>
<!DOCTYPE html>
<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/login.css">
</head>

<style>

    @import url("https://fonts.googleapis.com/css?family=Lato:400,700");
    #bg {
        background-image: url('img/background.jpg');
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-size: cover;
        filter: blur(5px);
    }
    .modal-content {
        background-color: #fefefe;
        margin: 3% auto 5% auto; /* 5% from the top, 15% from the bottom and centered */
        border: 1px solid #888;
        width: 80%;
    }
    /* Add Zoom Animation */
    .animate {
        -webkit-animation: animatezoom 0.6s;
        animation: animatezoom 0.6s
    }

    @-webkit-keyframes animatezoom {
        from {-webkit-transform: scale(0)}
        to {-webkit-transform: scale(1)}
    }

    @keyframes animatezoom {
        from {transform: scale(0)}
        to {transform: scale(1)}
    }

    form {
        width: 350px;
        position: relative;
    }
    form .form-field::before {
        font-size: 20px;
        position: absolute;
        left: 15px;
        top: 17px;
        color: #888888;
        content: " ";
        display: block;
        background-size: cover;
        background-repeat: no-repeat;
    }

    form .form-field {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        margin-bottom: 1rem;
        position: relative;
    }
    form input {
        font-family: inherit;
        width: 100%;
        outline: none;
        background-color: #fff;
        border-radius: 4px;
        border: none;
        display: block;
        padding: 0.9rem 0.7rem;
        box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16);
        font-size: 17px;
        color: #4A4A4A;
        text-indent: 40px;
    }
    form .btn {
        outline: none;
        border: none;
        cursor: pointer;
        display: inline-block;
        text-align: center;
        border-radius: 4px;
        box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16);
        font-size: 17px;
        background-color: #04AA6D;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        width: 20%;
        margin-top: 80px !important;
        margin-bottom: 80px !important;
    }


    button:hover {
        opacity: 0.8;
    }

</style>
<body>
<div id="bg"></div>
<div style="margin: auto;">
    <form class="modal-content animate" method="post">
        <h1 style="font-weight: bold; margin: auto; padding-top: 50px;">Student Engagement Portal Login</h1>
        <hr class="rounded" style="border-top: 8px solid #47AB11; border-radius: 5px;">
        <div class="row" style="font-size: 20px;margin: 10px;">
            <h2><label><b>Username:</b></label></h2>
            <div class="field_error" style="margin: auto; color: red;"><?php echo $msg ?></div>
            <input id="text" type="text" name="user_name" placeholder="Enter Username"><br><br>
            <h2 style="padding-top: 50px;"><label><b>Password:</b></label></h2>
            <input id="text" type="password" name="password" placeholder="Enter Password"><br><br>
            <button class="btn" style="margin: auto;" id="button" type="submit" value="Login">Login</button>
            <br><br><a href="forgot.php">Forgot Password?</a><br><br>
        </div>
    </form>
</div>
</body>
</html>
