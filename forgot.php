<?php
session_start();
$error = array();

require "mailer.php";

if (!$con = mysqli_connect("localhost", "root", "", "student_engagement_portal_db")) {

    die("could not connect");
}

$mode = "enter_email";
if (isset($_GET['mode'])) {
    $mode = $_GET['mode'];
}

//something is posted
if (count($_POST) > 0) {

    switch ($mode) {
        case 'enter_email':
            $email = $_POST['email'];
            //validate email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error[] = "Please enter a valid email";
            } elseif (!valid_email($email)) {
                $error[] = "That email was not found";
            } else {

                $_SESSION['forgot']['email'] = $email;
                send_email($email);
                header("Location: forgot.php?mode=enter_code");
                die;
            }
            break;

        case 'enter_code':
            $code = $_POST['code'];
            $result = is_code_correct($code);

            if ($result == "the code is correct") {

                $_SESSION['forgot']['code'] = $code;
                header("Location: forgot.php?mode=enter_password");
                die;
            } else {
                $error[] = $result;
            }
            break;

        case 'enter_password':
            $password = $_POST['password'];
            $password2 = $_POST['password2'];

            if ($password !== $password2) {
                $error[] = "Passwords do not match";
            } elseif (!isset($_SESSION['forgot']['email']) || !isset($_SESSION['forgot']['code'])) {
                header("Location: forgot.php");
                die;
            } else {

                save_password($password);
                if (isset($_SESSION['forgot'])) {
                    unset($_SESSION['forgot']);
                }

                header("Location: index.php");
                die;
            }
            break;

        default:
            break;
    }
}

function send_email($email)
{

    global $con;

    $expire = time() + (60 * 1);
    $code = rand(10000, 99999);
    $email = addslashes($email);

    $query = "insert into codes (email,code,expire) value ('$email','$code','$expire')";
    mysqli_query($con, $query);

    //send email here
    send_mail($email, 'Password reset', "Your code is " . $code);
}

function save_password($password)
{

    global $con;

    //$password = password_hash($password, PASSWORD_DEFAULT);
    $email = addslashes($_SESSION['forgot']['email']);

    $query = "update users set password = '$password' where email = '$email' limit 1";
    mysqli_query($con, $query);

}

function valid_email($email)
{
    global $con;
    $email = addslashes($email);

    $query = "select * from users where email = '$email' limit 1";
    $result = mysqli_query($con, $query);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            return true;
        }
    }
    return false;
}

function is_code_correct($code)
{
    global $con;

    $code = addslashes($code);
    $expire = time();
    $email = addslashes($_SESSION['forgot']['email']);

    $query = "select * from codes where code = '$code' && email = '$email' order by id desc limit 1";
    $result = mysqli_query($con, $query);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($row['expire'] > $expire) {

                return "the code is correct";
            } else {
                return "the code is expired";
            }
        } else {
            return "the code is incorrect";
        }
    }
    return "the code is incorrect";
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Forgot Password</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
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
<div id="bg"></div>
<form class="modal-content animate" method="post">
    <h1 style="font-weight: bold; margin: auto; padding-top: 50px;">Student Engagement Portal Forgot Password</h1>
    <hr class="rounded" style="border-top: 8px solid #47AB11; border-radius: 5px;">
    <div class="row" style="font-size: 20px;margin: 10px;">
        <div class="container" style="font-size: 20px;margin: 10px">


            <?php

            switch ($mode) {
            case 'enter_email':
                ?>
                <form class="modal-content animate" method="post" action="forgot.php?mode=enter_email">
                    <h5>Enter your email below</h5>

                    <span style="font-size: 12px;color:red;">
							<?php
                            foreach ($error as $err) {
                                echo $err . "<br>";
                            }
                            ?>
							</span>
                    <input class="textbox" type="email" name="email" placeholder="Email"><br>
                    <br style="clear: both;">
                    <input type="submit" value="Next">
                    <br><br>
                    <div><a href="index.php">Login</a></div>
                </form>
                <?php
                break;

            case 'enter_code':
                ?>
                <form class="modal-content animate" method="post" action="forgot.php?mode=enter_code">
                    <h5>Enter your the code sent to your email</h5>

                    <span style="font-size: 12px;color:red;">
							<?php
                            foreach ($error as $err) {
                                echo $err . "<br>";
                            }
                            ?>
							</span>

                    <input class="textbox" type="text" name="code" placeholder="12345"><br>
                    <br style="clear: both;">
                    <input type="submit" value="Next" style="float: right;">
                    <a href="forgot.php">
                        <input type="button" value="Start Over">
                    </a>
                    <br><br>
                    <div><a href="index.php">Login</a></div>
                </form>
                <?php
                break;

            case 'enter_password':
            ?>
            <form class="modal-content animate" method="post" action="forgot.php?mode=enter_password">
                <h5>Enter your new password</h5>

                <span style="font-size: 12px;color:red;">
							<?php
                            foreach ($error as $err) {
                                echo $err . "<br>";
                            }
                            ?>
							</span>

                <input class="textbox" type="text" name="password" placeholder="Password"><br>
                <input class="textbox" type="text" name="password2" placeholder="Retype Password"><br>
                <br style="clear: both;">
                <input type="submit" value="Next" style="float: right;">
                <a href="forgot.php">
                    <input type="button" value="Start Over">
                </a>
                <br><br>
                <div><a href="index.php">Login</a></div>
            </form>

        </div>
    </div>
</form>
</div>
</body>
<?php
break;

default:
    break;
}

?>


</html>
