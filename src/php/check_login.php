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
                header("Location: ../admin_index.php?error=Incorect User name or password");
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


function random_num($length){
    $text = "";
    if ($length < 5) {
        $length = 5;
    }
    $len = rand(4, $length);
    for ($i = 0; $i < $len; $i++) {
        $text .= rand(0, 9);
    }
    return $text;
}

?>