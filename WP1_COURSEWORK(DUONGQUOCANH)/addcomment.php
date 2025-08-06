<?php
try {
    include_once 'includes/DatabaseConnection.php';
    include_once 'includes/DatabaseFunctions.php';

    if (isset($_POST['submit_comment'])) {
        // Basic validation
        if (empty($_POST['comment_text']) || empty($_POST['question_id']) || empty($_POST['userid'])) {
            throw new Exception('Please fill in all fields');
        }

        // Provide name of the database function to get user details
        $user = getUser($pdo, $_POST['userid']);
        
        
        $query = 'INSERT INTO comments (question_id, name, comment_text, date) 
                 VALUES (:question_id, :name, :comment_text, NOW())';
        
        $params = [
            ':question_id' => $_POST['question_id'],
            ':name' => $user['name'], // 'name' is the field in the user table
            ':comment_text' => $_POST['comment_text']
        ];

        query($pdo, $query, $params);
        
        header('location: questions.php');
        exit();
    }
} catch (Exception $e) {
    $title = 'An error has occurred';
    $output = 'Error adding comment: ' . $e->getMessage();
    include 'templates/layout.html.php';
}

// Hàm lấy thông tin user
function getUser($pdo, $id) {
    $params = [':id' => $id];
    $query = query($pdo, 'SELECT * FROM user WHERE id = :id', $params);
    return $query->fetch();
}