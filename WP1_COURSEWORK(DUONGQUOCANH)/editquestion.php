<?php
try {
    include_once 'includes/DatabaseConnection.php';
    include_once 'includes/DatabaseFunctions.php';

    if (isset($_POST['submit'])) {
        $questionid = $_POST['questionid'];
        $ask = $_POST['ask'];
        $userid = $_POST['userid'];
        $moduleid = $_POST['moduleid'];
        
        // Handle file upload
        if (!empty($_FILES['questionimg']['name'])) {
            include_once 'includes/uploadfile.php';
            $questionimg = basename($_FILES['questionimg']['name']);
            move_uploaded_file($_FILES['questionimg']['tmp_name'], 'upload/' . $questionimg);
        } else {
            // If no new image is uploaded, keep the current image
            $questionimg = $_POST['current_image'] ?? '';
        }

        // Update question
        $query = 'UPDATE question 
                 SET ask = :ask, 
                     userid = :userid, 
                     moduleid = :moduleid, 
                     questionimg = :questionimg 
                 WHERE id = :id';
        
        $parameters = [
            ':ask' => $ask,
            ':userid' => $userid,
            ':moduleid' => $moduleid,
            ':questionimg' => $questionimg,
            ':id' => $questionid
        ];
        
        query($pdo, $query, $parameters);
        
        header('location: questions.php');
        exit();
    } else {
        $question = getquestion($pdo, $_GET['id']);
        $users = allUsers($pdo);
        $modules = allModules($pdo);
        $title = 'Edit Question';
        
        ob_start();
        include 'templates/editquestion.html.php';
        $output = ob_get_clean();
    }
} catch (PDOException $e) {
    $title = 'Error';
    $output = 'Error editing question: ' . $e->getMessage();
}

include 'templates/layout.html.php';