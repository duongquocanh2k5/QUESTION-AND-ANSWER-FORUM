<?php 
try {
    include_once 'includes/DatabaseConnection.php';
    include_once 'includes/DatabaseFunctions.php';
    
    if(isset($_POST['add_module'])) {
        // Add New Module
        addmodule($pdo, $_POST['module_name']);
    }
    
    if(isset($_POST['delete_module'])) {
        // delete module
        deletemodule($pdo, $_POST['id']);
    }

    // show all modules in the database to the list 
    $modules = allModules($pdo);
    $title = 'Add/Delete Module';
    
    ob_start();
    include 'templates/addmodule.html.php';
    $output = ob_get_clean();

} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

include 'templates/layout.html.php';