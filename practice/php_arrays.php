<?php

    $cards = array("ace", "jack", "king", "queen", "ten");
    
    //print_r($cards); //for debugging purposes. show all elements
    
    //$cards[] = 2; // adds new element to the last index of array. ONLY 1

    //array_push($cards, 3, 4); //ADD MULTIPLE ELEMENTS.

    
    //$cards[6] = "ten";
   

    //$lastCard = array_pop($card); // RETRIEVES and REMOVES the last item.
    
   
    //unset($cards[5]);// removes element from array.
    //print_r($cards);// print array
    
    //$cards = array_values($cards); // RETRIEVES and re-arranges indices array.
    
    //shuffle($cards); //shuffles cards.
    
    $randomIndex = rand(0 , count($cards)-1);
    displayCard($cards[$randomIndex]);
    $randomIndex = array_rand($cards); // generates a random index.
    displayCard($cards[$randomIndex]);
    
    function displayCard($card){
        // global $cards; //using variable that is outside of the function.
        // echo "<img src='img/cards/clubs/$cards[2].png' />";
        
        echo "<img src='img/cards/clubs/$card.png' />";
        
        
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
    </head>
    <body>

    </body>
</html>