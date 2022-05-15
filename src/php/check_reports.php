<?php
function check_reports($con)
{
    function check_reports($con)
    {
        if (isset($_SESSION['id'])) {
            $user_id = $_SESSION['id'];
            $query = "select * from modules where id = '$user_id' limit 1";

            $result = mysqli_query($con, $query);
            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                return $user_data;
                $result = mysqli_query($con, $query);

                if ($row['password'] === $password) {
                    $_SESSION['$name'] = $row['name'];
                    $_SESSION['$module_id'] = $row['module_id'];
                    $_SESSION['$role'] = $row['role'];
                    $_SESSION['$user_name'] = $row['user_name'];
                    header("Location: ../home.php");
                } else {
                    header("Location: ../index.php?error=Incorrect User name or password");
                }
            }
        }
        //redirect to login
        header("Location: login.php");
        die;
    }

    if (isset($_POST['user_name']) && isset($_POST['password']) && isset($_POST['role'])) {
        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $user_name = test_input($_POST['user_name']);
        $password = test_input($_POST['password']);
        $role = test_input($_POST['role']);
    }

    function check_login($con)
    {
        if (isset($_SESSION['id'])) {
            $user_id = $_SESSION['id'];
            $query = "select * from users where id = '$user_id' limit 1";
            $result = mysqli_query($con, $query);
            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                return $user_data;
                $result = mysqli_query($con, $query);
                if ($row['password'] === $password) {
                    $_SESSION['$name'] = $row['name'];
                    $_SESSION['$id'] = $row['id'];
                    $_SESSION['$role'] = $row['role'];
                    $_SESSION['$user_name'] = $row['user_name'];
                    header("Location: ../home.php");
                } else {
                    header("Location: ../index.php?error=Incorrect User name or password");
                }
            }
        }
        //redirect to login
        header("Location: login.php");
        die;
    }
}

?>

