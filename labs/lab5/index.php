<?php
    // Creating a new session.
    session_start();
    
    // When the the 'cart' hasn't been made, create it
    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    
    // Checks to see if a product has been added to the cart.
    if(isset($_POST['itemName'])) {
        
        // Storing the information into $newItem variable for every product.
        $newItem = array();
        $newItem['name'] = $_POST['itemName'];    // Name of the product.
        $newItem['id'] = $_POST['itemId'];        // Product ID.
        $newItem['price'] = $_POST['itemPrice'];  // Price of the product.
        $newItem['image'] = $_POST['itemImage'];  // Image of the product.
        
        // Checks to see if the products are the same then just increase quantity 
        // instead of pushing the same product twice to the cart.
        foreach($_SESSION['cart'] as &$item) {
            if($newItem['id'] == $item['id']) {
                $item['quantity'] += 1;
                $found = true;
            }
        }
        
        // Checks to see if the product you are going to push into the cart array
        // was not already in the shopping cart. 
        if($found != true) {
            // The quantity of the new product will be one.
            $newItem['quantity'] = 1;
            array_push($_SESSION['cart'], $newItem);
        }
    }
    
    // Including the functions.php file that was created in another file.
    include 'functions.php';
    
    // Checks to see if the form button was submitted
    if(isset($_GET['query'])) {
        //Including the Walmart API file.
        include 'wmapi.php';
        //Getting the query for the product name and passing it into the getProducts function
        //from the API, then storing the result in $items that will be used later on.
        $items = getProducts($_GET['query']);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <title>Shopping Land</title>
    </head>
    <body>
    <div class='container'>
        <div class='text-center'>
            
            <!-- Bootstrap Navagation Bar -->
            <nav class='navbar navbar-default - navbar-fixed-top'>
                <div class='container-fluid'>
                    <div class='navbar-header'>
                        <a class='navbar-brand' href='#'>Shopping Spree</a>
                    </div>
                    <ul class='nav navbar-nav'>
                        <li><a href='index.php'>Home</a></li>
                        <li><a href='scart.php'>
                        <span class='glyphicon glyphicon-shopping-cart' aria-hidden='true'>
                        </span> Cart: <?php displayCartCount(); ?></a></li>
                    </ul>
                </div>
            </nav>
            <br> <br> <br>
            
            <!-- Search Form -->
            <form enctype="text/plain">
                <div class="form-group">
                    <label for="pName">Product Name</label>
                    <input type="text" class="form-control" name="query" id="pName" placeholder="Enter the name of the product">
                </div>
                <input type="submit" value="Search" class="btn btn-default">
                <br /><br />
            </form>
            <br> <br> <br> 
            <!-- Display Search Results -->
            <?php displayResults(); ?>
        </div>
    </div>
    </body>
</html>