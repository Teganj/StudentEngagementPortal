<?php
include("../connection.php");
include("../check_login.php");
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

$studentCount = $con->query("SELECT * from reports ");
if ($result = mysqli_query($con, $sql)) {
    $rowcount = mysqli_num_rows($result);
}

echo '<pre>';
var_dump($_SESSION);
echo '</pre>';

?>
<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h1 class="box-title">Welcome, <?php echo $_SESSION['name']; ?></h1>
                    </div>
                    <div class="card-body--">
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
