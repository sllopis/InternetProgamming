<!DOCTYPE html>
<html>
    <head>
        <title>inspireME Official - Quote Generator</title>
        <meta charset="utf-8"/>
        <link href="css/styles.css" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
        
    </head>
    
    <div id="banner" >
        <img id="banner" src='img/banner.jpg' />
    </div>
        
    <body>
        <header>
            <h1> The best quotes to empower your day and your life </h1>
        </header>
        <hr>
        
        
         <div id="main">
                <form>
                <button id="button">+</button>
            </form>
             <?php
                include 'inc/functions.php';
                start();
             ?>
            
            
            <form>
                <button id="button">+</button>
            </form>
        </div>
    </body>
    
    <footer>
        <hr>
        <img id="footerPic" src='img/csumb.jpeg' alt="CSUMB logo" />
        <img id="footerPic" src='img/buddy_verified.png' alt="Buddy Verified."/>
        <p style="color:white">CST 336 Internet Programming &copy;2018. All rights reserved. <br>
                    Sergio Llopis Doñate</p>
    </footer>
    
 </html>