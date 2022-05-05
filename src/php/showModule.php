<?php
$k = $_POST['id'];
$k = trim($k);

$con = mysqli_connect("localhost", "root", "", "student_engagement_portal_db");
$sql = "SELECT * FROM reports WHERE module_name='{$k}'";
$res = mysqli_query($con, $sql);


while($rows = mysqli_fetch_array($res)){

    ?>

<tr>
    <td> <?php echo $rows['name']; ?> </td>
    <td> <?php echo $rows['email']; ?> </td>
    <td> <?php echo $rows['week1']; ?> </td>
    <td> <?php echo $rows['week2']; ?> </td>
    <td> <?php echo $rows['week3']; ?> </td>
    <td> <?php echo $rows['week4']; ?> </td>

</tr>

<?php

}
echo $sql;
?>