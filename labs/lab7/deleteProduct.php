<?php

 include '../../dbConnection.php';
    
 $connection = getDatabaseConnection("heroku_aa693a7a56d9950");
    
 $sql = "DELETE FROM om_product WHERE productId = " . $_GET['productId'];

 $statement = $connection->prepare($sql);
 $statement->execute();
  
 header("Location: admin.php");
 
?>