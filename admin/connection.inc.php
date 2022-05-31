<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "student_engagement_portal_db");
define('SERVER_PATH', $_SERVER['DOCUMENT_ROOT'] . '/php/student_engagement_portal_db/');
define('SITE_PATH', 'http://127.0.0.1/php/student_engagement_portal_db/');
define('PRODUCT_IMAGE_SERVER_PATH', SERVER_PATH . 'media/product/');
define('PRODUCT_IMAGE_SITE_PATH', SITE_PATH . 'media/product/');
?>
