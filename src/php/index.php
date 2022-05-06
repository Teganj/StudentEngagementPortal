<?php
session_start();
include("connection.php");
include("check_login.php");


$con = mysqli_connect("localhost", "root", "", "student_engagement_portal_db");
$sql = "SELECT module_name FROM reports";
$res = mysqli_query($con, $sql);


if (!empty($_GET['status'])) {
    switch ($_GET['status']) {
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



if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //something was posted
    $course_name = $_POST['course_name'];
    $module_name = $_POST['module_name'];

    if (!empty($course_name) && !empty($module_name)) {

            //Insert data into DB
            $user_id = random_num(20);
            $query = ("INSERT INTO reports (course_name, module_name) VALUES ('" . $course_name . "', '" . $module_name . "')");
            $query = ("INSERT INTO uploads (course_name, module_name) VALUES ('" . $course_name . "', '" . $module_name . "')");

            mysqli_query($con, $query);

            header("Location: dashboard.php");
            die;
        }

}
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Student Engagement Portal</title>
    <script scr="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/login_style.css">
    <script type="text/javascript" scr="../javascript/dashboard.js"></script>


    <script>
        function formToggle(ID) {
            var element = document.getElementById(ID);
            if (element.style.display === "none") {
                element.style.display = "block";
            } else {
                element.style.display = "none";
            }
        }
    </script>
    <style>
        table {
            border: 1px solid;
            border-collapse: collapse;
            padding: 10px;

        }

        td, td, tr {
            border: 1px solid;
        }
    </style>
</head>

<body style="padding-bottom: 100px;">

<!-- Display status message -->
<?php if (!empty($statusMsg)) { ?>
    <div class="col-xs-12">
        <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
    </div>
<?php } ?>
<?php include 'navbar.php' ?>

<h2 style="text-align: center; margin-top: 5px;">Add a New Module</h2>
<form class="modal-content animate" method="post">
    <div class="row" style="font-size: 20px; margin: 10px; padding: 10px">

        <label for="course_name">Choose Course:</label><br>
        <select id="course_name" name="course_name">
            <option value="certcomp">Certificate in Computing</option>
            <option value="hdipcomp">HDip in Computing</option>
            <option value="hdipda">HDip in Data Analytics</option>
            <option value="hdipwd">HDip in Web Design</option>
            <option value="hdipcs">HDip in Cyber Security</option>
            <option value="msccs">MSC in Cyber Security</option>
            <option value="mscda">MSC in Data Analytics</option>
        </select>

        <br>
        <label><b>Enter Module Name:</b></label>
        <input id="text" type="text" name="module_name"
               placeholder="Module Name eg. Software Development Jan22"><br><br>

        <?php include 'csv_upload.php' ?><br>

        <button id="button" type="submit" value="dashboard.php">Create Module</button>

    </div>
</form>


<h2 style="text-align: center; margin-top: 10px;">Quick View of a Module</h2>
<div class="modal-content animate" style="margin-top: 5px; margin-bottom: 5px;">
    <div class="row" style=" padding: 2%;">
        <select id="module" onchange="selectModule()" style="width: 50%;">
            <?php while ($rows = mysqli_fetch_array($res)) {
                ?>
                <option value="<?php echo $rows['module_name']; ?> ">  <?php echo $rows['module_name']; ?> </option>
                <?php
            }
            ?>
        </select>
    </div>
    <div class="row" style=" padding: 2%;">
    <table style="padding-top: 20px; margin-top: 20px; width: 90%;">
        <thead>
        <th>Student Name</th>
        <th>Email</th>
        <th>Activity 1</th>
        <th>Activity 2</th>
        <th>Activity 3</th>
        <th>Activity 4</th>
        <th>Activity 5</th>
        <th>Activity 6</th>
        </thead>
        <tbody id="ans">
        </tbody>
    </table>
</div>
</div>


</body>
</html>