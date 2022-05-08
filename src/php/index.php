<?php
session_start();
include("connection.php");
include("check_login.php");

$con = mysqli_connect("localhost", "root", "", "student_engagement_portal_db");
$sql = "SELECT  DISTINCT module_name FROM reports";
$res = mysqli_query($con, $sql);

//Get status message
if (!empty($_GET['status'])) {
    switch ($_GET['status']) {
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Members data has been imported successfully.';
            break;
        case 'err':
            $statusType = 'alert-danger';
            $statusMsg = 'Some problem occurred, please try again.';
            break;
        case 'invalid_file':
            $statusType = 'alert-danger';
            $statusMsg = 'Please upload a valid CSV file.';
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
    <title>Add Module</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/login_style.css">
    <link rel="stylesheet" href="../css/style.css">
    <script type="text/javascript" scr="../javascript/selectModule.js"></script>
    <script scr="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script scr="js/jquery.min.js"

    <script>
        function selectModule(){
            var x =document.getElementById("module").value;

            $.ajax({
                url:"../php/showModule.php",
                method: "POST",
                data: {
                    id : x
                },
                success: function(data){
                    $("#ans").html(data);
                }
            })

        }
    </script>
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
    <?php if (!empty($statusMsg)) { ?>
        <div class="col-xs-12">
            <div class="alert <?php echo $statusMsg; ?>"><?php echo $statusMsg; ?></div>
        </div>
    <?php } ?>
</head>

<body style="padding-bottom: 100px;">
<?php include 'navbar.php' ?>


<h1 style="text-align: center; font-weight: bold; margin: auto; padding-top: 50px;">Add a New Module</h1>
<form class="modal-content animate" enctype="multipart/form-data" method="post" action="importData.php">
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
        <label for="module_name" style="padding-top: 20px; padding-bottom: 0px; "><b>Enter Module Name:</b></label>
        <input for="module_name" id="module_name" type="text" name="module_name"
               placeholder="Module Name eg. Software Development Jan22"><br><br>
        <input type="file" name="file"/>
        <input value="Create Module" id="button" style="margin: 10px; width: 30%;" type="submit" value="dashboard.php"
               name="addToUpload">
    </div>
</form>


<h1 style="text-align: center; font-weight: bold; margin: auto; padding-top: 50px;padding-bottom: 50px;">Quick View of a Module</h1>
<div class="modal-content animate" style="margin-top: 5px; margin-bottom: 5px; padding: 2%">
    <select id="module" onchange="selectModule()" style="width: 50%; padding: 10px;">
        <?php while ($rows = mysqli_fetch_array($res)) {
            ?>
            <option value="<?php echo $rows['module_name']; ?> ">
                <?php echo $rows['module_name']; ?> </option>
            <?php
        }
        ?>
    </select>
    <div class="row" style=" padding: 2%;">
        <table style="padding-top: 20px; margin-top: 20px; width: 90%;" id="quickModuleView">
            <thead>
                <th>Student Name</th>
                <th>Activity 1</th>
                <th>Activity 2</th>
                <th>Activity 3</th>
                <th>Activity 4</th>
                <th>Activity 5</th>
                <th>Activity 6</th>
                <th>Activity 7</th>
                <th>Activity 8</th>
                <th>Activity 9</th>
                <th>Activity 10</th>
                <th>Activity 11</th>
                <th>Activity 12</th>
            </thead>
            <tbody id="ans">
            </tbody>
        </table>
    </div>
</div>


</body>
</html>