<?php

    session_start();
    
    include '../dbConnection.php';
    
    if(!isset( $_SESSION['adminName']))
    {
      header("Location:login.php");
    }
    //heroku_aa693a7a56d9950
    $connection = getDatabaseConnection("library");
    
    function getCategories($catId) {
        global $connection;
        
        $sql = "SELECT catID, catName from category ORDER BY catName";
        
        $statement = $connection->prepare($sql);
        $statement->execute();
        $records = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($records as $record) {
            echo "<option  ";
            echo ($record["catID"] == $catId)? "selected": " "; 
            echo " value='".$record["catID"] ."'>". $record['catName'] ." </option>";
        }
    }
    
    function getAuthor($authorID){
        
        global $connection;
        
        $sql = "SELECT distinct authorID, authorName FROM author ORDER BY authorName";
        
        $statement = $connection->prepare($sql);
        $statement->execute();
        $records = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($records as $record) {
            echo "<option  ";
            echo ($record["authorID"] == $authorID) ? "selected": " "; 
            echo " value='".$record["authorID"] ."'>". $record['authorName'] ." </option>";
        }
    }
    
    function getProductInfo()
    {
        global $connection;
        $sql = "SELECT * FROM book WHERE bookID = " . $_GET['bookID'];
    
        //echo $_GET["productId"];
        
        $statement = $connection->prepare($sql);
        $statement->execute();
        $record = $statement->fetch(PDO::FETCH_ASSOC);
        
        return $record;
    }
    
    if (isset($_GET['updateProduct'])) {
        
        global $connection;
        
        $bookName = $_GET['productName'];
        $productDescription = $_GET['description'];
        $productImage = $_GET['productImage'];
        $productPrice = $_GET['price'];
        $catId = $_GET['catId'];
        $productId = $_GET['productId'];
        $authorID = $_GET['authorID'];
        
        //echo "Trying to update the product!";
        
        $sql = "UPDATE book
                SET bookName = :productName,
                    bookDescription = :productDescription,
                    bookImage = :productImage,
                    price = :price,
                    authorID = :authorID,
                    categoryID = :catId
                WHERE bookID = :productId";

        
        $namedParameters = array();
        $namedParameters[':productName'] = $bookName;
        $namedParameters[':productDescription'] = $productDescription;
        $namedParameters[':productImage'] = $productImage;
        $namedParameters[':price'] = $productPrice;
        $namedParameters[':catId'] = $catId;
        $namedParameters[':authorID'] = $authorID;
        $namedParameters[':productId'] = $productId;
        
        
        
        $statement = $connection->prepare($sql);
        $statement->execute($namedParameters);
        
    }
    
    
    if(isset ($_GET['bookID']))
    {
        $product = getProductInfo();
    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>CSUMB Shop - Update Book </title>
        <link href="css/styles.css" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
        <link href="css/styles.css" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    </head>
    <body>
         <div class="container">
            <div class="jumbotron">
                <div class="container text-center">
                <h1>Update a Book</h1>      
                  <p>Now you can update your books by filling out this form. </p>
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
                </ul>
                

            </div>
        </div>
       <div class="col-md-8">
            <!-- Content Here -->
            <form>
                <input type="hidden" name="productId" value= "<?=$product['bookID']?>"/>
                 <div class="form-group">
                    <label for="productName">Book Name:</label>
                    <input class="form-control" id="productName" type="text" value = "<?=$product['bookName']?>" name="productName">
                <br></div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control" id="description" name="description" cols = 50 rows = 4><?=$product['bookDescription']?></textarea>
                <br></div>
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input class="form-control" id="price" type="text" name="price" value = "<?=$product['price']?>">
                <br></div>
                <div class="form-group">
                    <label for="authorID">Author:</label>
                    <select class="form-control" id="authorID" name="authorID">
                        <option>Select One</option>
                        <?php getAuthor( $product['authorID']  ); ?>
                    </select>
                <br></div>
                <div class="form-group">
                    <label for="catID">Category:</label>
                    <select class="form-control" id="catID" name="catId">
                        <option>Select One</option>
                        <?php getCategories( $product['categoryID']  ); ?>
                    </select>
                <br></div>
                <div class="form-group">
                    <label for="productImage">Set Image Url: </label>
                    <input class="form-control" id="productImage" type ="text" name ="productImage" value = "<?=$product['bookImage']?>"><br>
                <br></div>
                <div class="form-group">
                <div style="text-align:center" class="container">
                    <input class="btn btn-info btn-rounded" type="submit" name="updateProduct" value="Update Product">
                <br></div>
                </div>
            </form>
            
            <?php 
                if(isset($_GET['updateProduct'])){
                    echo "<div class='container text-center'><div class='alert alert-success' role='alert'>
                        <strong>Congratulations!</strong> You successfully updated your product.
                        </div></div>";
                }    
            ?>
        </div>
    </div>
</div>
        
     