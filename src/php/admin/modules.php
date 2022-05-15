<?php
require('top.inc.php');

if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value($con, $_GET['type']);

    if ($type == 'delete') {
        $id = get_safe_value($con, $_GET['id']);
        $delete_sql = "delete from modules where id='$id'";
        mysqli_query($con, $delete_sql);
    }
}

$sql = "select * from modules order by id desc";

$res = mysqli_query($con, $sql);
?>
<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">MODULES</h4>
                        <h4 class="box-link"><a href="manage_modules.php">Add Module</a></h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                <tr>
                                    <th width="2%">ID</th>
                                    <th width="20%">Course Code</th>
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
                                            if ($row['status'] == 1) {
                                                echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=" . $row['id'] . "'>Active</a></span>&nbsp;";
                                            } else {
                                                echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=" . $row['id'] . "'>Deactive</a></span>&nbsp;";
                                            }
                                            echo "<span class='badge badge-edit'><a href='manage_modules.php?id=" . $row['id'] . "'>Edit</a></span>&nbsp;";

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
