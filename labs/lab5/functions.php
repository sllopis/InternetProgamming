<?php

    // Creating a function that will display the results based on the query from the product given.
    function displayResults() {
        // Access Global $items array
        global $items;
        
        // Checks to see if the form button was submitted and there ARE items set.
        if(isset($items)) {
            // Creating a table for each item as ONE row.
            echo "<table class='table'>";
            
            foreach($items as $item) {
                $itemName = $item['name'];
                $itemPrice = $item['salePrice'];
                $itemImage = $item['thumbnailImage'];
                $itemId = $item['itemId'];
                
                echo "<tr>";
                echo "<td> <img src='$itemImage'></td>";
                echo "<td><h4>$itemName</h4></td>";
                echo "<td><h4>$$itemPrice</h4></td>";
                
                // Hidden form containing the product's information.
                echo "<form method='post'>";
                echo "<input type='hidden' name='itemName' value='$itemName'>";
                echo "<input type='hidden' name='itemId' value='$itemId'>";
                echo "<input type='hidden' name='itemImage' value='$itemImage'>";
                echo "<input type='hidden' name='itemPrice' value='$itemPrice'>";
                
                // Checks to see if user submitted the Add button or not.
                if($_POST['itemId'] == $itemId) {
                    // If so, then an ADDED button in green will appear.
                    echo "<td><button class='btn btn-success'>Added</button></td>";
                } else {
                    // If not, an ADD button in orange will show up.
                    echo "<td><button class='btn btn-warning'>Add</button></td>";
                }
                
                // Ending the form syntax.
                echo "</form>";
                echo "</tr>";
            }
            // Ending the table syntax.
            echo "</table>";
        }
    }
    
    function displayCart() {
        // If the 'cart' is already created, display its items
        if(isset($_SESSION['cart'])) {
            echo "<table class='table'>";
            foreach($_SESSION['cart'] as $item) {
                $itemName = $item['name'];
                $itemId = $item['id'];
                $itemPrice = $item['price'];
                $itemImage = $item['image'];
                $itemQuant = $item['quantity'];
                
                // Display item as table row
                echo "<tr>";
                
                echo "<td><img src='$itemImage'></td>";
                echo "<td><h4>$itemName</h4></td>";
                echo "<td><h4>$$itemPrice</h4></td>";
                echo "<td><h4>$itemQuant</h4></td>";
                
                // Hidden input element containing the item name
                echo "<form method='post'>";
                echo "<input type='hidden' name='itemId' value='$itemId'>";
                echo "<td><input type='text' name='update' class='form-control' placeHolder='$itemQuant'></td>";
                echo "<td><button class='btn btn-danger'>Update</button></td>";
                echo "</form>";
                
                echo "<form method='post'>";
                echo "<input type='hidden' name='removeId' value='$itemId'>";
                echo "<td><button class='btn btn-danger'>Remove</button></td>";
                echo "</form>";
                
                echo "</tr>";
            }
            echo "</table>";
        }
    }
    
    // Creating a function to display the count of the number of items in the shopping cart.
    function displayCartCount() {
        echo count($_SESSION['cart']);
    }
?>