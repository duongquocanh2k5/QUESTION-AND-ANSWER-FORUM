<?php
if(isset($_POST['comment_id']) && isset($_POST['question_id'])) {
    try {
        include_once 'includes/DatabaseConnection.php';
        include_once 'includes/DatabaseFunctions.php';
        
        deleteComment($pdo, $_POST['comment_id']);
        
        // Chuyển hướng trở lại trang questions với question_id
        header('location: questions.php?id=' . $_POST['question_id']);
        exit();
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
        include 'templates/layout.html.php';
    }
}