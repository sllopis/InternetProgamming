<?php

session_start();
if(!isset( $_SESSION['adminName']))
{
  header("Location:index.php");
}
include '../../dbConnection.php';
$conn = getDatabaseConnection("heroku_aa693a7a56d9950");

function displayAllProducts(){
    global $conn;
    $sql="SELECT * FROM om_product";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    //print_r($records);

    return $records;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Admin Main Page </title>
        <link href="css/styles.css" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
    
        <style>
        
            form{
                display:inline; 
            }
        </style>
        
        <script>
            function confirmDelete(){
                return confirm("Are you sure you want to delete it?")
            }
        </script>
    </head>
    <body>


        
        <h1> Admin Main Page </h1>
        
        <h3> Welcome <?=$_SESSION['adminName']?>! </h3>
        
        <br />
        <form action="addProduct.php">
            <input type="submit" name="addproduct" value="Add Product"/>
        </form>
        
        <form action="logout.php">
            <input type="submit"  value="Logout"/>
        </form>
        
        <br />
        <strong> Products: </strong> <br />
        
        <?php $records=displayAllProducts();
            foreach($records as $record) {
               // echo "[<a href='updateProduct.php?productId=".$record['productId']."'>Update</a>]";
                
                echo "<form action='updateProduct.php'>";
                echo "<input type='hidden' name='productId' value= ".$record['productId'] . " />";
                echo "<input type='submit' value='Edit'>";
                echo "</form>";
                
                // "[<a href='deleteProduct.php?productId=".$record['productId']."'>Delete</a>]";
                
                echo "<form action='deleteProduct.php' onsubmit='return confirmDelete()'>";
                echo "<input type='hidden' name='productId' value= ".$record['productId'] . " />";
                echo "<input type='submit' value='Delete'>";
                echo "</form>";
                
                echo $record['productName'];
                echo '<br>';
            }
        
        ?>

    </body>
</html>

