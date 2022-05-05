<?php

$content = $_GET["content"];
$file = uniqid() . ".html";
file_put_contents($file, $content);
$current = file_get_contents($file);
file_put_contents($file, $current, FILE_APPEND | LOCK_EX);
echo $file;

?>