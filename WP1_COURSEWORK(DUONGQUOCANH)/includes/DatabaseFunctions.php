<?php 
function totalquestions($pdo){
    $query = query($pdo, 'SELECT COUNT(*)FROM question');
    $row = $query->fetch();
    return $row[0];
} 

function query($pdo, $sql, $parameters = []) {
    $query = $pdo->prepare($sql);
    $query->execute($parameters);
    return $query;
}

function getquestion($pdo, $id) {
    $parameters = [':id' => $id];
    $query = query($pdo,'SELECT * FROM question WHERE id = :id', $parameters);
    return $query->fetch();
}

function updatequestion($pdo, $questionid, $ask, $questionimg) {
    $query = 'UPDATE question SET ask = :ask, questionimg = :questionimg WHERE id = :id';
    $parameters = [':ask' => $ask, ':questionimg'=>$questionimg, ':id' => $questionid];
    query($pdo, $query, $parameters);
}

function deletequestion($pdo, $id) 
{
    try {
        //Start transaction
        $pdo->beginTransaction();
        
        // Delete ALL comments of this question
        $parameters = [':question_id' => $id];
        $commentQuery = 'DELETE FROM comments WHERE question_id = :question_id';
        query($pdo, $commentQuery, $parameters);
        
        // Delete the question
        $questionQuery = 'DELETE FROM question WHERE id = :id';
        query($pdo, $questionQuery, [':id' => $id]);
        
        // Commit transaction if all queries are successful
        $pdo->commit();

        return true;
    } catch (PDOException $e) {
        // If an error occurs, roll back the transaction
        $pdo->rollBack();
        throw $e;
    }
}

function insertquestion($pdo, $ask, $userid, $moduleid, $questionimg) {
    $query = 'INSERT INTO question (ask, userid, moduleid, questionimg)
              VALUES (:ask, :userid, :moduleid, :questionimg)';
    $parameters = [':ask' => $ask, ':userid' => $userid, ':moduleid' => $moduleid, ':questionimg' => $questionimg];
    query($pdo, $query, $parameters);
}


function allUsers($pdo){
    $users = query($pdo, 'SELECT * FROM user');
    return $users->fetchAll();
}

function allModules($pdo){
    $modules = query($pdo, 'SELECT * FROM  module');
    return $modules->fetchAll();
}

function allquestions($pdo){
    $questions = query($pdo, 'SELECT *, question.id as questid FROM question
    INNER JOIN user ON userid = user.id
    INNER JOIN module ON moduleid = module.id');
    return $questions->fetchAll();
}

function addmodule($pdo, $module_name) {
    $query = 'INSERT INTO module (module_name) VALUES (:module_name)';
    $parameters = [':module_name' => $module_name];
    query($pdo, $query, $parameters);
}

function deletemodule($pdo, $id) {
    $parameters = [':id' => $id];
    query($pdo, 'DELETE FROM module WHERE id = :id', $parameters);



}
function addComment($pdo, $questionId, $userId, $commentText) {
    $query = 'INSERT INTO comments (question_id, userid, comment_text) 
              VALUES (:questionId, :userId, :commentText)';
}

function getComments($pdo, $questionId) 
{
    $query = 'SELECT comments.*, user.name, user.email 
              FROM comments 
              INNER JOIN user ON comments.userid = user.id 
              WHERE question_id = :questionId 
              ORDER BY date DESC';
}

function addUser($pdo, $name, $email) {
    $query = 'INSERT INTO user (name, email) VALUES (:name, :email)';
    $parameters = [
        ':name' => $name,
        ':email' => $email
    ];
    query($pdo, $query, $parameters);
}

function deleteUser($pdo, $id) {
    $parameters = [':id' => $id];
    query($pdo, 'DELETE FROM user WHERE id = :id', $parameters);
}

function deleteComment($pdo, $commentId) {
    try {
        $parameters = [':id' => $commentId];
        query($pdo, 'DELETE FROM comments WHERE id = :id', $parameters);
        return true;
    } catch (PDOException $e) {
        throw $e;
    }
}
?>