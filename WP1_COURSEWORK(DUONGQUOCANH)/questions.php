<?php
try{
    include_once 'includes/DatabaseConnection.php';
    include_once 'includes/DatabaseFunctions.php';
    
 

    $questions = allquestions($pdo);
    $title = 'Question list';
    $totalquestions = totalquestions($pdo);
    
    if (isset($_GET['id'])) {
    $question = getquestion($pdo, $_GET['id']);
    $comments = getComments($pdo, $_GET['id']); // Đảm bảo dòng này tồn tại
}
    
    ob_start();
    include 'templates/questions.html.php';
    $output = ob_get_clean();    
}catch (PDOException $e){
    $title = 'An error has occured';
    $output= 'Database error:' .$e->getMessage();
}
include 'templates/layout.html.php';