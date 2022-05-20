<?php
include 'connection.php';
function check_login($con)
{
    if (isset($_SESSION['id'])) {
        $id = $_SESSION['user_id'];
        $query = "select * from users where id = '$id' limit 1";
        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);

            return $user_data;
            $result = mysqli_query($con, $query);


            if ($row['password'] === $password) {
                $_SESSION['$name'] = $row['name'];
                $_SESSION['$user_id'] = $row['user_id'];
                $_SESSION['$role'] = $row['role'];
                $_SESSION['$user_name'] = $row['user_name'];

                $_SESSION['$module_name'] = $row['module_name'];

                echo $user_data;


            } else {
                header("Location: ../index.php?error=Incorrect User name or password");
            }

        }
    }

}
check_login($con);
?>

