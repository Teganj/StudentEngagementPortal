<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "heroku_c20da7f7108e04f");
define('SERVER_PATH', $_SERVER['DOCUMENT_ROOT'] . '/php/heroku_c20da7f7108e04f/');
define('SITE_PATH', 'http://eu-cdbr-west-02.cleardb.net/php/heroku_c20da7f7108e04f/');
define('PRODUCT_IMAGE_SERVER_PATH', SERVER_PATH . 'media/product/');
define('PRODUCT_IMAGE_SITE_PATH', SITE_PATH . 'media/product/');
?>
