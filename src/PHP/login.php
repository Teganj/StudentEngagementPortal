<?php
   ob_start();
   session_start();
?>

<?

$client = new MongoDB\Client(
    'mongodb+srv://tegan:Cassidhe1!@cluster0.c8vya.mongodb.net/Project0?retryWrites=true&w=majority');

$db = $client->test;

?>
<!DOCTYPE html>
<html>
<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../CSS/login_style.css">
    <link rel="stylesheet" href="../CSS/main_style.css">
    <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>


</head>
<body>

<nav class="navbar navbar-icon-top navbar-expand-lg" style="background-color: #784794;">
    <a class="navbar-brand" href="#" style="color: white; font-weight: bold;">NCI Student Engagement</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#" style="color: white; ">
                    <i class="fa fa-home"></i>
                    Home
                    <span class="sr-only">(current)</span>
                </a>
            </li>
        </ul>
    </div>
</nav>


<h2 style="text-align: center; margin-top: 10px;">National College of Ireland Student Retention Portal Login</h2>

<div style="margin-top: 0px; margin-bottom: 0px;">
    <form class="modal-content animate" action="../HTML/upload.html" method="post">
        <div class="container">
            <div class = "container form-signin">

                <?php
                $msg = '';

                if (isset($_POST['login']) && !empty($_POST['username'])
                    && !empty($_POST['password'])) {

                    if ($_POST['username'] == '12345' &&
                        $_POST['password'] == '12345') {
                        $_SESSION['valid'] = true;
                        $_SESSION['timeout'] = time();
                        $_SESSION['username'] = '12345';

                        echo 'You have entered valid use name and password';
                    }else {
                        $msg = 'Wrong username or password';
                    }
                }
                ?>
            </div>
            <div class = "container">

                <form class = "form-signin" role = "form"
                      action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);
                      ?>" method = "post">
                    <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
                    <input type = "text" class = "form-control"
                           name = "12345" placeholder = "username = 12345"
                           required autofocus></br>
                    <input type = "password" class = "form-control"
                           name = "password" placeholder = "password = 1234" required>
                    <button class = "btn btn-lg btn-primary btn-block" type = "submit"
                            name = "login">Login</button>
                </form>
            <label for="username"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="uname" required>

            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>

            <button type="submit">Login</button>

            <label><input type="checkbox" checked="checked" name="remember"> Remember me</label>
        </div>
        <div class="container" style="background-color:#f1f1f1; margin-bottom: 10px;">
            <span class="psw">Forgot <a href="#">password?</a></span>
        </div>
    </form>
</div>
</body>
</html>
