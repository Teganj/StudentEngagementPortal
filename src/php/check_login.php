<?php
function check_login($con)
{
    if (isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];
        $query = "select * from users where user_id = '$id' limit 1";

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

                header("Location: ../home.php");

            } else {
                header("Location: ../index.php?error=Incorrect User name or password");
            }

        }
    }
}

?>

