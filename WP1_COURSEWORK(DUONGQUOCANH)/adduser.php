<?php
try {
    include_once 'includes/DatabaseConnection.php';
    include_once 'includes/DatabaseFunctions.php';
    
    if(isset($_POST['add_user'])) {
        // add new user
        addUser($pdo, $_POST['name'], $_POST['email']);
    }
    
    if(isset($_POST['delete_user'])) {
        // delete user
        deleteUser($pdo, $_POST['id']);
    }

    // Get the list of users to display
    $users = allUsers($pdo);
    $title = 'Add/Delete User';
    
    ob_start();
    include 'templates/adduser.html.php';
    $output = ob_get_clean();

} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

include 'templates/layout.html.php';