<?php
session_start();
include("connection.php");
include("check_login.php");

$con = mysqli_connect("localhost", "root", "", "student_engagement_portal_db");
$sql = "SELECT  DISTINCT module_name FROM reports";
$res = mysqli_query($con, $sql);

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


<h1 style="text-align: center; font-weight: bold; margin: auto; padding-top: 50px;padding-bottom: 50px;">Quick View of a Module</h1>
<div class="modal-content animate" style="margin-top: 5px; margin-bottom: 5px; padding: 2%">
    <select id="module" onchange="selectModule()" style="width: 50%; padding: 10px; margin: auto;">
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