<?php
    
    include '../../dbConnection.php';
    $conn = getDatabaseConnection("ottermart");

    $productId = $_GET['productId'];

    $sql = "SELECT * FROM `om_product`
            NATURAL JOIN om_purchase 
            WHERE productId = :pId";    
    
    $np = array();
    $np[":pId"] = $productId;
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($np);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //print_r($records);
    echo "<h1> Products Purchased </h1>";
    echo "";
    
    echo "<div id='purchased'>";
    echo $records[0]['productName'] . "<br>";
    echo "<br>";
    echo "<img src='" . $records[0]['productImage'] . "' width='150' /><br/>";
    echo "<br>";
    foreach ($records as $record) {
        
        echo "Purchase Date: " . $record["purchaseDate"] . "<br />";
        echo "Unit Price: " . $record["unitPrice"] . "<br />";
        echo "Quantity: " . $record["quantity"] . "<br />";
     
    }
     echo "</div>";
 ?>

<!DOCTYPE html>
<html>
    <head>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
		<link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
        <title>Products Purchase</title>
    </head>
    <body>
    </body>
    <footer>
		CST 336 Internet Programming &copy;Lab 6
		<img src="img/csumb.jpeg" alt="California State University" />
	</footer>
</html>