<?php

  $backgroundImage = "img/sea.jpg";
    
  if (!isset($_GET['submit']) || !empty($_GET['keyword']) || !empty($_GET['category'])) { //if form was submitted
      
      include 'api/pixabayAPI.php';
      
      $keyword = $_GET['keyword'];
      
      if(!empty($_GET['keyword'])){
        echo "<h3>You searched for " . $_GET['keyword'] . "</h3>";
      }
      else{
        
      }
      
      
      
      if (isset($_GET['layout'])) {  //user checked a layout
        
        $orientation = $_GET['layout'];
        
      }
      else{
        $orientation = "horizontal"; 
      }
      
      if (!empty($_GET['category'])) { //user selected a category
      
        $keyword = $_GET['category'];
      }
      
      $imageURLs = getImageURLs($keyword, $orientation);
      
      $backgroundImage = $imageURLs[array_rand($imageURLs)];
  }
  else{
      echo "<h2> You must type a keyword or select a category </h2>";
  }
 

 function checkCategory($category){
   
    if ($category == $_GET['category']) {
       echo " selected";
    }
 }

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Lab 4: Pixabay Carousel </title>
        <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
    </head>
    <style>
        @import url("https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css");
        @import url("css/styles.css");
        body {
           background-image: url(<?=$backgroundImage?>);
           background-size: 100% 100%;
           background-attachment: fixed;
           font-family: 'Indie Flower', cursive;
        }
        
        h3,h2{
          position: absolute;
          top: 150px;
          left:300px;
          width: 1000px;
          opacity:0.9;
          font-size:1.3em;
          color:yellow;
        }
         
        #carouselExampleIndicators {
            width: 500px;
            margin: 0 auto; /*centers a div container*/
            top:100px;
        }
        
        input[type=submit] {
          padding:5px 15px; 
          background:#ccc; 
          border:0 none;
          cursor:pointer;
          -webkit-border-radius: 5px;
          border-radius: 5px;
          
        }
        input[type=text] {
        padding:5px; 
        border:2px solid #ccc; 
        -webkit-border-radius: 5px;
        border-radius: 5px;
        color:green;
        }

        input[type=text]:focus {
          border-color:#333;
        }
        
        #hlayout{
          top:100px;
        }
         
         
    </style>
    <body>

        <?php
        
            if (empty($_GET['category']) && empty($_GET['keyword'])) {
        
              echo "<h2> You must type a keyword or select a category </h2>";
            }  
        ?>

        

        <form method="GET">
            
            <input id="keyword" type="text" size="20" name="keyword" placeholder="Keyword to search for" value="<?=$_GET['keyword']?>"/>
            
            <input type="radio" name="layout" value="horizontal" id="hlayout" 
            
            <?php
               if ($_GET['layout'] == "horizontal") {
                 echo "checked";
               }
            ?>
            
            >
            <label for="hlayout"> Horizontal </label>
            
            <input type="radio" style="border-radius:20px;"name="layout" value="vertical" id="vlayout" <?= ($_GET['layout']=="vertical")?"checked":"" ?>>
            <label for="vlayout"> Vertical </label>
            
            <select name="category">
              <option value="" >  Select One </option> 
              <option value="sea" <?=checkCategory('sea')?>>  Ocean </option>
              <option <?=checkCategory('Forest')?>>  Forest </option>
              <option <?=checkCategory('Sky')?>>  Sky </option>
            </select>
            
            
            <input type="submit" name="submit" style="border-radius:40px; color:yellow; background-color: #4CAF50;" value="Search"/>
                    
        </form>
        
        <?php
          
           if (!empty($_GET['keyword']) || !empty($_GET['category'])) {
        ?>
        
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="6s"></li>
              </ol>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img class="d-block w-100" src="<?=$imageURLs[0]?>" alt="First slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="<?=$imageURLs[1]?>" alt="Second slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="<?=$imageURLs[2]?>" alt="Third slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="<?=$imageURLs[3]?>" alt="Third slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="<?=$imageURLs[4]?>" alt="Third slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="<?=$imageURLs[5]?>" alt="Third slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="<?=$imageURLs[6]?>" alt="Third slide">
                </div>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
        </div>
        
        <?php
            }//endIf
        ?>
        
        

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    </body>
</html>