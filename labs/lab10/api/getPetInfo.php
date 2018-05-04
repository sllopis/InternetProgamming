<?php
    include '../../../dbConnection.php';

    if(!$_GET['id']){
        return false;
        exit(1);
    }

    $conn = getDatabaseConnection('heroku_aa693a7a56d9950');
    
    $sql = "SELECT *, YEAR(CURDATE()) - yob age FROM pets WHERE id = :id";
    
    $stmt = $conn->prepare($sql);  
    $stmt->execute(array(":id"=>$_GET['id']));
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    //print_r($record);  
    
    echo json_encode($record);
?>