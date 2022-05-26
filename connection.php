<?php
//$dbhost = "localhost";
//$dbuser = "root";
//$dbpass = "";
//$dbname = "student_engagement_portal_db";


$dbhost = "eu-cdbr-west-02.cleardb.net";
$dbuser = "b5180f50d8a282";
$dbpass = "ab6a5a25";
$dbname = "heroku_c20da7f7108e04f";

if (!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
    die("failed to connect!");
}
?>
