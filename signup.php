<?php
session_start();
include("connection.php");
include("check_login.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //something was posted
    $user_name = $_POST['user_name'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if (!empty($user_name) && !empty($name) && !empty($email) && !empty($password) && !empty($role) && !is_numeric($user_name)) {
        mysqli_query($con, "insert into users(user_name, name, password, email, role, status) values('$user_name', '$name', '$password','$email','$role',1)");

        header("Location: login.php");
        die;
    } else {
        echo "Please enter some valid information!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/login.css">
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
            <input id="text" type="text" name="user_name"><br><br>
            <h2><label><b>Name:</b></label></h2>
            <input id="text" type="text" name="name"><br><br>
            <h2><label><b>Email:</b></label></h2>
            <input id="text" type="text" name="email"><br><br>
            <h2 style="padding-top: 50px;"><label><b>Password:</b></label></h2>
            <input id="text" type="password" name="password" placeholder="Enter Password"><br><br>
            <label for="role" class=" form-control-label">Role</label>
            <select id="role" name="role" value="<?php echo $role ?>">
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
            <input id="button" type="submit" value="Signup"><br><br>
            <a href="login.php">Login</a><br><br>
        </div>
    </form>
</div>

</body>
</html>
