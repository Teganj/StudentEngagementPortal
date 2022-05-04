<?php  

if (isset($_SESSION['user_name']) && isset($_SESSION['user_id'])) {
    
    $sql = "SELECT * FROM users ORDER BY user_id ASC";
    $res = mysqli_query($con, $sql);
}else{
	header("Location: index.php");
} 