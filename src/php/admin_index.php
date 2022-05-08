<?php 
    session_start();
	include("connection.php");
	include("check_login.php");

    if(!empty($_GET['status'])){
        switch($_GET['status']){
            case 'succ':
                $statusType = 'Alert-Success';
                $statusMsg = "Report Information has been imported successfully";
                break;
            case 'err':
                $statusType = 'Alert-danger';
                $statusMsg = "Problem occurred, please try again";
                break;
            case 'invalid_file':
                $statusType = 'Alert-danger';
                $statusMsg = "Please upload a csv file.";
                break;
            default:
                $statusType = '';
                $statusMsg = '';
        }
    }
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Student Engagement Portal</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="../css/admin_index_style.css">

        <script>
            function formToggle(ID){
                var element = document.getElementById(ID);
                if(element.style.display === "none"){
                    element.style.display = "block";
                }else{
                    element.style.display = "none";
                }
            }
        </script>

        <!-- Display status message -->
        <?php if (!empty($statusMsg)) { ?>
            <div class="col-xs-12">
                <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
            </div>
        <?php } ?>

    </head>
    <body>
        <?php include 'admin_navbar.php' ?>

        <div class="container">
            <h2>Admin Controls</h2>

            <div class="row">
                <a href="admin_addUser.php">
                    <button class="button button1">Add New User</button>
                </a>
            </div>
            <br>
            <div class="row">
                <a href="admin_updateUser.php">
                    <button class="button button1">Update an Existing User</button>
                </a>
            </div>
            <br>
            <div class="row">
                <a href="admin_deleteUser.php">
                    <button class="button button1">Delete an Existing User</button>
                </a>
            </div>
            <br>
            <div class="row">
                <a href="">
                    <button class="button button1">Manage Module Reports</button>
                </a>
            </div>
            <br>
            <div class="row">
                <a href="admin_createModule.php">
                    <button class="button button1">Add Module Report</button>
                </a>
            </div>
            <br>
        </div>
    </body>
</html>