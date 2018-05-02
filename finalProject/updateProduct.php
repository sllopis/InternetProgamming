<?php

    session_start();
    include '../dbConnection.php';
    
    if(!isset( $_SESSION['adminName']))
    {
      header("Location:login.php");
    }
    
    $connection = getDatabaseConnection("library");
    
    function getCategories($catId) {
    global $connection;
    
    $sql = "SELECT catID, catName from category ORDER BY catName";
    
    $statement = $connection->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($records as $record) {
        echo "<option  ";
        echo ($record["catID"] == $catId)? "selected": ""; 
        echo " value='".$record["catID"] ."'>". $record['catName'] ." </option>";
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
        
        $productName = $_GET['productName'];
        $productDescription = $_GET['description'];
        $productImage = $_GET['productImage'];
        $productPrice = $_GET['price'];
        $catId = $_GET['catId'];
        $productId = $_GET['productId'];
        
        //echo "Trying to update the product!";
        
        $sql = "UPDATE book
                SET bookName = :bookName,
                    bookDescription = :bookDescription,
                    bookImage = :bookImage,
                    price = :price,
                    categoryID = :catId
                WHERE bookID = :bookID";

        
        $namedParameters = array();
        $namedParameters[':bookName'] = $productName;
        $namedParameters[':bookDescription'] = $productDescription;
        $namedParameters[':bookImage'] = $productImage;
        $namedParameters[':price'] = $productPrice;
        $namedParameters[':catId'] = $catId;
        $namedParameters[':bookID'] = $productId;
        
        
        
        $statement = $connection->prepare($sql);
        $statement->execute($namedParameters);
        
    }
    
    
    if(isset ($_GET['productId']))
    {
        $product = getProductInfo();
    }
    
    print_r($product);

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
                <input type="hidden" name="productId" value= "<?=$product['productId']?>"/>
                 <div class="form-group">
                    <label for="productName">Book Name:</label>
                    <input class="form-control" id="productName" type="text" value = "<?=$product['productName']?>" name="productName">
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control" id="description" name="description" cols = 50 rows = 4><?=$product['productDescription']?></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input class="form-control" id="price" type="text" name="price" value = "<?=$product['price']?>">
                </div>
                <div class="form-group">
                    <label for="catID">Category:</label>
                    <select class="form-control" id="catID" name="catId">
                        <option>Select One</option>
                        <?php getCategories( $product['catId'] ); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="productImage">Set Image Url: </label>
                    <input class="form-control" id="productImage" type ="text" name ="productImage" value = "<?=$product['productImage']?>"><br>
                </div>
                <div style="text-align:center" class="container">
                    <input class="btn btn-info btn-rounded" type="submit" name="updateProduct" value="Update Product">
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
        
     