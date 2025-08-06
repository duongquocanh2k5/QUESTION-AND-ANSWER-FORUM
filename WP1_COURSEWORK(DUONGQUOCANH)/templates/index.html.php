<?php 
$title = 'GREENWICH Question and Answers FORUM';
ob_start();
include 'templates/home.html.php';
$output = ob_get_clean();
include 'templates/layout.html.php';