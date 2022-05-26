<?php
if (isset($_SESSION['user_id'])) {
    unset($_SESSION['user_id']);
}
session_destroy();
header("Location: login.php");
die;
?>