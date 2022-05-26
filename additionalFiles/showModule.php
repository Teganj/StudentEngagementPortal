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
        <td> <?php echo $rows['activity1']; ?> </td>
        <td> <?php echo $rows['activity2']; ?> </td>
        <td> <?php echo $rows['activity3']; ?> </td>
        <td> <?php echo $rows['activity4']; ?> </td>
        <td> <?php echo $rows['activity5']; ?> </td>
        <td> <?php echo $rows['activity6']; ?> </td>
        <td> <?php echo $rows['activity7']; ?> </td>
        <td> <?php echo $rows['activity8']; ?> </td>
        <td> <?php echo $rows['activity9']; ?> </td>
        <td> <?php echo $rows['activity10']; ?> </td>
        <td> <?php echo $rows['activity11']; ?> </td>
        <td> <?php echo $rows['activity12']; ?> </td>
    </tr>

    <?php
    }
    echo $sql;
?>