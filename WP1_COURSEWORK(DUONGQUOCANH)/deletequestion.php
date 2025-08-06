<?php
try{
    include_once 'includes/DatabaseConnection.php';
    include_once 'includes/DatabaseFunctions.php';
    deletequestion($pdo,$_POST['questid']);
    header('location: questions.php');
}catch(PDOExpception $e){
    $title = 'An error has occured';
    $output = 'Unable to connect to delete Question:'.$e->getMessage();
}
include 'templates/layout.html.php';