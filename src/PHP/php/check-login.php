<?php  
session_start();
include "../connection.php";

if (isset($_POST['user_name']) && isset($_POST['password']) && isset($_POST['role'])) {

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$user_name = test_input($_POST['user_name']);
	$password = test_input($_POST['password']);
	$role = test_input($_POST['role']);

	if (empty($user_name)) {
		header("Location: ../login.php?error=User Name is Required");
	}else if (empty($password)) {
		header("Location: ../login.php?error=Password is Required");
	}else {

		// Hashing the password
		$password = md5($password);
        
        $sql = "SELECT * FROM users WHERE user_name='$user_name' AND password='$password'";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) === 1) {
        	// the user name must be unique
        	$row = mysqli_fetch_assoc($result);
        	if ($row['password'] === $password) {
        		$_SESSION['name'] = $row['name'];
        		$_SESSION['user_id'] = $row['user_id'];
        		$_SESSION['role'] = $row['role'];
        		$_SESSION['user_name'] = $row['user_name'];

        		header("Location: ../index.php");

        	}else {
        		header("Location: ../login.php?error=Incorrect User name or password");
        	}
        }else {
        	header("Location: ../login.php?error=Incorrect User name or password");
        }

	}
	
}else {
	header("Location: ../login.php");
}