<?php

 session_start();
 
 include '../dbConnection.php';
 
 if(!isset($_SESSION['adminName']))
 {
   header("Location:login.php");
 }
    
 $connection = getDatabaseConnection("heroku_aa693a7a56d9950");
    //heroku_aa693a7a56d9950
 $sql = "DELETE FROM book WHERE bookID = " . $_GET['bookID'];

 $statement = $connection->prepare($sql);
 $statement->execute();
  
 header("Location: admin.php");
 
?>  