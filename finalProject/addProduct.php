<?php

session_start();

include "../dbConnection.php";
$conn = getDatabaseConnection("library");

if(!isset( $_SESSION['adminName']))
{
  header("Location:login.php");
}

function getCategories() {
    global $conn;
    
    $sql = "SELECT catID, catName from category ORDER BY catName";
    
    $statement = $conn->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($records as $record) {
        echo "<option value='".$record["catID"] ."'>". $record['catName'] ." </option>";
    }
}

if (isset($_GET['submitProduct'])) {
    $productName = $_GET['productName'];
    $productDescription = $_GET['description'];
    $productImage = $_GET['productImage'];
    $productPrice = $_GET['price'];
    $catId = $_GET['catId'];
    
    $sql = "INSERT INTO book
            ( `bookName`, `bookDescription`, `bookImage`, `price`, `categoryID`) 
             VALUES ( :bookName, :bookDescription, :bookImage, :price, :categoryID)";
    
    $namedParameters = array();
    $namedParameters[':bookName'] = $productName;
    $namedParameters[':bookDescription'] = $productDescription;
    $namedParameters[':bookImage'] = $productImage;
    $namedParameters[':price'] = $productPrice;
    $namedParameters[':categoryID'] = $catId;
    
    //only for inserting or deleting, JUST PREPARE AND EXECUTE.
    $statement = $conn->prepare($sql);
    $statement->execute($namedParameters);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title> CSUMB Library - Add a book </title>
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
        <link href="css/styles.css" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
    
    </head>
    <body>
        <div class="container">
            <div class="jumbotron">
                <div class="container text-center">
                <h1>Add a new book</h1>      
                  <p>Now you can add a new book into the database by filling out this form. </p>
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
                     <li><a href="admin.php"> <span class="glyphicon glyphicon-th"></span> Back to Panel</a></li>
                     <li class="active"><a href="addProduct.php"> <span class="glyphicon glyphicon-plus"></span> Add Product</a></li>
                </ul>
            </div>
        </div>
        
        <div class="col-md-8">
            <!-- Content Here -->
            <form>
                 <div class="form-group">
                    <label for="productName">Book Name:</label>
                    <input class="form-control" id="productName" type="text" name="productName"><br>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control"id="description" name="description" cols = 50 rows = 4></textarea><br>
                </div>
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input class="form-control" type="text" id="price" name="price"><br>
                </div>
                <div class="form-group">
                    <label for="catID">Category:</label>
                    <select class="form-control" id="catID" name="catId">
                        <option value="">Select One</option>
                        <?php getCategories(); ?>
                    </select> <br />
                </div>
                <div class="form-group">
                    <label for="productImage">Set Image Url: </label>
                    <input class="form-control" type = "text" id="productImage" name = "productImage"><br>
                </div>
                <div style="text-align:center" class="container">
                    <input class="btn btn-info btn-rounded" type="submit" name="submitProduct" value="Add Product">
                </div>
            </form>
            
            <?php 
                if(isset($_GET['submitProduct'])){
                    echo "<div class='container text-center'><div class='alert alert-success' role='alert'>
                        <strong>Congratulations!</strong> You successfully added a new product.
                        </div></div>";
                }    
            ?>
        </div>
    </div>
</div>
    </body>
</html>