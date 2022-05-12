<?php
require('top.inc.php');
isAdmin();

$sql="select * from modules order by id desc";
$res=mysqli_query($con,$sql);


if(isset($_GET['type']) && $_GET['type']!=''){
    $type=get_safe_value($con,$_GET['type']);

    if($type=='delete'){
        $id=get_safe_value($con,$_GET['id']);
        $delete_sql="delete from modules where id='$id'";
        mysqli_query($con,$delete_sql);
    }
}

$studentCount = $con->query("SELECT * from reports ");
if ($result = mysqli_query($con, $sql)) {
    $rowcount = mysqli_num_rows( $result );
}
?>
<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">DASHBOARD MANAGEMENT</h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                            <thead>
                            <tr>
                                <th width="2%">ID</th>
                                <th width="20%">Course</th>
                                <th width="20%">Module Name</th>
                                <th width="20%">Student Count</th>
                                <th width="26%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i=1;
                            while($row=mysqli_fetch_assoc($res)){?>
                                <tr>
                                    <td><?php echo $row['id']?></td>
                                    <td><?php echo $row['course']?></td>
                                    <td><?php echo $row['module_name']?></td>
                                    <td><?php echo $rowcount; ?></td>

                                    <td>
                                        <?php
                                        echo "<span class='badge badge-success'><a href='../viewModule.php?id=".$row['id']."'>View</a></span>&nbsp;";
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