<?php
if(isset($_POST['ask'])){
    try{
        include_once 'includes/DatabaseConnection.php';
        include_once 'includes/DatabaseFunctions.php';
        include_once 'includes/uploadfile.php';
        insertquestion($pdo, $_POST['ask'],$_POST['userid'],$_POST['moduleid'], $target_file);
        
        header('location: questions.php');
      
    }catch (PDOException $e){
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
    }
}else{
    include_once 'includes/DatabaseConnection.php';
    include_once 'includes/DatabaseFunctions.php';
    $title = 'Ask a question';
    $users = allUsers($pdo); 
    $modules = allModules($pdo);
    ob_start();
    include 'templates/addquestion.html.php';
    $output = ob_get_clean();
}
include 'templates/layout.html.php';