<?php
    $k = $_POST['id'];
    $k = trim($k);

    $con = mysqli_connect("localhost", "root", "", "student_engagement_portal_db");
    $sql = "SELECT * FROM reports WHERE name='{$k}'";
    $res = mysqli_query($con, $sql);
    while($rows = mysqli_fetch_array($res)){
    ?>

        <label><b>Username</b></label>
        <input id="text" type="text" name="user_name" required placeholder="Required" value=" <?php echo $rows['user_name']; ?> "><br><br>

        <label><b>Name</b></label>
        <input id="text" type="text" name="name" placeholder="Update Name" value="<?php echo $rows['name']; ?>"><br><br>

        <label><b>Email</b></label>
        <input id="text" type="text" name="email" placeholder="Update Email" value="<?php echo $rows['email']; ?>"><br><br>

        <label><b>Password</b></label>
        <input id="text" type="password" name="password" placeholder="Update Temporary Password" value="<<?php echo $rows['password']; ?>"><br><br>

        <label for="role">Update User Role:</label>
        <select id="role" name="roles" <?php echo $rows['role']; ?>>
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select>

<!--    <tr>-->
<!--        <td> --><?php //echo $rows['user_name']; ?><!-- </td>-->
<!--        <td> --><?php //echo $rows['name']; ?><!-- </td>-->
<!--        <td> --><?php //echo $rows['email']; ?><!-- </td>-->
<!--        <td> --><?php //echo $rows['password']; ?><!-- </td>-->
<!--        <td> --><?php //echo $rows['role']; ?><!-- </td>-->
<!--    </tr>-->

    <?php
    }
    echo $sql;
?>