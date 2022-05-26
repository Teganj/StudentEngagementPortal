<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "student_engagement_portal_db";

if (!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
    die("failed to connect!");
}
?>
