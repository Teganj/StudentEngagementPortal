<?php
include("connection.php");
include("check_login.php");
require('top.inc.php');

$user_data = check_login($con);

$sql = "select * from modules order by id desc";
$res = mysqli_query($con, $sql);

if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value($con, $_GET['type']);

    if ($type == 'delete') {
        $id = get_safe_value($con, $_GET['id']);
        $delete_sql = "delete from modules where id='$id'";
        mysqli_query($con, $delete_sql);
    }
}

?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Student Engagement Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body" style="padding-bottom: 100px;">
                        <h1 class="box-title">Welcome, <?php echo $_SESSION['name']; ?></h1>
                        <h4 class="box-link"><a href="user_manage_modules.php">Add Module</a></h4>

                        <div class="card-body--">
                            <h3 style="text-align: center; font-weight: bold; margin: auto; padding: 50px;">Your
                                Modules</h3>
                            <div class="table-stats order-table ov-h">
                                <table class="table ">
                                    <thead>
                                    <tr>
                                        <th width="2%">ID</th>
                                        <th width="20%">Course</th>
                                        <th width="20%">Module Name</th>
                                        <th width="26%"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['id'] ?></td>
                                            <td><?php echo $row['course'] ?></td>
                                            <td><?php echo $row['module_name'] ?></td>
                                            <td>
                                                <?php
                                                echo "<span class='badge badge-success'><a href='viewModule.php?id=" . $row['id'] . "'>View</a></span>&nbsp;";
                                                echo "<span class='badge badge-edit'><a href='user_manage_modules.php?id=" . $row['id'] . "'>Edit</a></span>&nbsp;";
                                                echo "<span class='badge badge-delete'><a href='?type=delete&id=" . $row['id'] . "'>Delete</a></span>";
                                                ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
