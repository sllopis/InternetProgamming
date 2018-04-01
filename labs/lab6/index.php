<?php

    include '../../dbConnection.php';
    
    $conn = getDatabaseConnection("ottermart");

    function displayCategories(){
        global $conn;
        
        $sql = "SELECT catId, catName FROM `om_category` ORDER BY catName";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        //print_r($records);
        
        foreach ($records as $record) {
            
            echo "<option value='".$record["catId"]."' >" . $record["catName"] . "</option>";
        }
    }
    
    function displaySearchResults(){
        global $conn;
        
        if (isset($_GET['searchForm'])) { //checks whether user has submitted the form
            
            echo "<h1>Products Found: </h1>"; 
            
            //following sql works but it DOES NOT prevent SQL Injection
            //$sql = "SELECT * FROM om_product WHERE 1
            //       AND productName LIKE '%".$_GET['product']."%'";
            
            //Query below prevents SQL Injection
            
            $namedParameters = array();
            
            $sql = "SELECT * FROM om_product WHERE 1";
            
            if (!empty($_GET['product'])) { //checks whether user has typed something in the "Product" text box
                 $sql .=  " AND productName LIKE :productName";
                 $namedParameters[":productName"] = "%" . $_GET['product'] . "%";
            }
            
            if (!empty($_GET['category'])) { //checks whether user has typed something in the "Product" text box
                 $sql .=  " AND catId = :categoryId";
                 $namedParameters[":categoryId"] =  $_GET['category'];
            }        
            
            if (!empty($_GET['priceFrom'])) { 
                 $sql .=  " AND price >= :priceFrom";
                 $namedParameters[":priceFrom"] =  $_GET['priceFrom'];
            } 
            
            if (!empty($_GET['priceTo'])) { 
                 $sql .=  " AND price <= :priceTo";
                 $namedParameters[":priceTo"] =  $_GET['priceTo'];
            } 
            
            if (isset($_GET['orderBy'])) { 
                 
                 if($_GET['orderBy'] == "price"){
                     $sql .=  " ORDER BY price";
                 }
                 else{
                     $sql .=  " ORDER BY productName";
                 }
            } 
            
            //echo $sql; //for debugging purposes
            
             $stmt = $conn->prepare($sql);
             $stmt->execute($namedParameters);
             $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            foreach ($records as $record) {
                echo "<a href=\"purchaseHistory.php?productId=".$record['productId']."\">" . $record['productName'] . " " . $record['productDescription'] . " $" . $record['price'] . "<br /><br /></a>";
                //echo $record['productName'] . " " . $record['productDescription'] . " $" . $record['price'] . "<br /><br />";
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
		<link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
        <title> OtterMart Product Search </title>
    </head>
    <body>

        <h1>  OtterMart Product Search </h1>
        
        <form>
            
            <label for="product"><strong>Name:</strong></label>
            <input id="product" type="text" name="product" value="<?=$_GET['product']?>" /><br />
            
            <br />

            <label for="category"><strong>Category:</strong></label> 
                <select id="category" name="category" value="<?=$_GET['category']?>">
                    <option value=""> Select One </option>
                    <?=displayCategories()?>
                </select>
                
            <br /><br />
            
            <label for="from"><strong>Price:</strong></label> 
            <label for="from">From:</label>
            <input id="from" type="text" name="priceFrom" size="7"/>
            <label for="to">To:</label>
            <input id="to"type="text" name="priceTo" size="7"/>
                    
            <br />
            <br />
        
            <label for="orderPrice"><strong>Order result by:</strong></label> 
            <label for="orderPrice">Price</label> 
            <input id="orderPrice" type="radio" name="orderBy" value="price"/>
            <label for="orderName">Name</label> 
            <input id="orderName" type="radio" name="orderBy" value="name"/>
             
            <br /><br />
            <input type="submit" value="Search" name="searchForm" />
             
        </form>
        
        <br />
        <hr>
        
        <?= displaySearchResults() ?>

    </body>
    
    <footer>
			CST 336 Internet Programming &copy;Lab 6
		<img style="width:100px" src="img/buddy_verified.png" alt="Buddy" />
	</footer>
</html>