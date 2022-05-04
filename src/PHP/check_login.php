<?php
    function check_login($con){
        if(isset($_SESSION['user_id'])){
            $id = $_SESSION['user_id'];
            $query = "select * from users where user_id = '$id' limit 1";

            $result = mysqli_query($con,$query);
            if($result && mysqli_num_rows($result) > 0){
                $user_data = mysqli_fetch_assoc($result);
                return $user_data;
            }

            //Checking if User is Admin or not, 0=user, 1=admin
            $user_role = $_SESSION['role_id'];

            //If user has user role
            if($_SESSION['$user_role'] == '0'){
                $_SESSION['message'] = "Welcome to user dashboard";
                header("Location: index.php");
                exit(0);
            }

            //If user have admin role
            if($_SESSION['$user_role'] == '1'){
                $_SESSION['message'] = "Welcome to admin dashboard";
                header("Location: ../Admin/index.php");
                exit(0);
            }

        }
        //redirect to login
        header("Location: login.php");
        die;
    }

    function random_num($length){
        $text = "";
        if($length < 5){
            $length = 5;
        }
        $len = rand(4,$length);
        for ($i=0; $i < $len; $i++) {
            $text .= rand(0,9);
        }
        return $text;
    }
?>