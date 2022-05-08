<?php
session_start();
include("connection.php");
include("check_login.php");

$user_data = check_login($con);


$con = mysqli_connect("localhost", "root", "", "student_engagement_portal_db");
$sql = "SELECT name FROM users";
$res = mysqli_query($con, $sql);


?>


<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script scr="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/login_style.css">
    <script type="text/javascript" scr="../javascript/admin_updateUser.js"></script>
    <script>
        function selectUser() {
            var x = document.getElementById("name").value;

            $.ajax({
                url: "/showUser.php",
                method: "POST",
                data: {
                    id: x
                },
                success: function (data) {
                    $("#ans").html(data);
                }
            })

        }

    </script>


</head>
<body>
<?php include 'admin_navbar.php' ?>



<h1 style="text-align: center; font-weight: bold; margin: auto; padding-top: 50px;">Update User Information</h1>
<form class="modal-content animate"  enctype="multipart/form-data" method="GET"">
<div class="row" style="font-size: 20px; margin: 10px; padding: 10px">

    <h3 style="text-align: center; font-weight: bold; margin: auto; padding-top: 50px;">Select a User to Update</h3><br>

    <select id="updateUser" onchange="updateUser()">
        <?php while ($rows = mysqli_fetch_array($res)) {
            ?>
            <option value="<?php echo $rows['name']; ?> ">  <?php echo $rows['name']; ?> </option>
            <?php
        }
        ?>
    </select>

    <label><b>Username</b></label>
    <input id="text" type="text" name="user_name"><br><br>

    <label><b>Name</b></label>
    <input id="text" type="text" name="name"><br><br>

    <label><b>Email</b></label>
    <input id="text" type="text" name="email"><br><br>

    <label><b>Password</b></label>
    <input id="text" type="password" name="password"><br><br>

    <label for="role">Choose a role for user:</label>
    <select id="role" name="role">
        <option value="admin">Admin</option>
        <option value="user">User</option>
    </select>
    <button id="button" type="submit" style="margin: 10px; width: 30%;" value="admin_index.php">Update User</button>
</div>
</form>


</body>
</html>