<?php

session_start();
if(!isset( $_SESSION['adminName']))
{
  header("Location:login.php");
}


include '../dbConnection.php';
$conn = getDatabaseConnection("library");

function displayAllProducts(){
    global $conn;
    $sql="SELECT * FROM book";
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
        <title> CSUMB Shop - Management Page </title>
        <link href="css/styles.css" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
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
        <div class="container">
            <div class="jumbotron">
                <div class="container text-center">
                <h1>Database Management</h1>      
                  <p>Here you can modify the books of your database by using this panel. </p>
                </div>
        </div>
        
        <div class="container">
            <div class="row">
            <div class="col-md-4">
            <!-- It can be fixed with bootstrap affix http://getbootstrap.com/javascript/#affix-->
            <div id="sidebar" class="well sidebar-nav">
                <h5><i class="glyphicon glyphicon-user"></i>
                    <small><b>USERS</b></small>
                    <h5> Welcome <?=$_SESSION['adminName']?>! </h5>
                </h5>
                 <br />
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Homepage</a></li>
                    <li class="active"><a href="admin.php"><span class="glyphicon glyphicon-th"></span> Management Panel</a></li>
                    <li><a href="addProduct.php"> <span class="glyphicon glyphicon-plus"></span> Add Product</a></li>
                    <li><a href="report.php"> <span class="glyphicon glyphicon-list-alt"></span> Report</a></li>
                    <li><a href="logout.php"> <span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                </ul>
                

            </div>
        </div>
        <div class="col-md-8">
            <!-- Content Here -->
            <strong><h1>Books</h1> </strong> <br />
                
             <?php $records=displayAllProducts();
                    foreach($records as $record) {
               // echo "[<a href='updateProduct.php?productId=".$record['productId']."'>Update</a>]";
                
                echo "<form action='updateProduct.php'>";
                echo "<input type='hidden' name='bookID' value= ".$record['bookID'] . " />";
                echo "<input type='submit' value='Edit'>";
                echo "</form>";
                
                // "[<a href='deleteProduct.php?productId=".$record['productId']."'>Delete</a>]";
                
                echo "<form action='deleteProduct.php' onsubmit='return confirmDelete()'>";
                echo "<input type='hidden' name='bookID' value= ".$record['bookID'] . " />";
                echo "<input type='submit' name='deleteProduct' value='Delete'>";
               
                echo "</form>";
                
                echo " - " . $record['bookName'];
                echo '<br>';
            }
        
        ?>
        </div>
    </div>
</div>
    </body>
</html>

