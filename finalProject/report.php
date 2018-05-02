<?php

session_start();
if(!isset( $_SESSION['adminName']))
{
  header("Location:login.php");
}

include '../dbConnection.php';
$conn = getDatabaseConnection("library");

function countHowManyBooks(){
    
    global $conn;
    $sql="SELECT DISTINCT count(bookID) FROM book";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $record = $statement->fetch(PDO::FETCH_ASSOC);
    
    //print_r($records);

    echo "<h3><span style='color:darkblue'><strong>NUMBER</span> of books in the DB is: <span style='color:darkblue'><strong>" . $record['count(bookID)'] . "</strong></span></h3>";
}

function getMaximumBookPrice(){
    
    global $conn;
    $sql="SELECT max(price) FROM book";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $record = $statement->fetch(PDO::FETCH_ASSOC);

    echo "<h3>The <span style='color:darkblue'><strong>MOST EXPENSIVE</span> book costs: <span style='color:darkblue'><strong>$" . number_format((float)$record['max(price)'], 2, '.', '') . "</strong></span></h3>";
}

function getMinimumBookPrice(){
    
    global $conn;
    $sql="SELECT min(price) FROM book";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $record = $statement->fetch(PDO::FETCH_ASSOC);

    echo "<h3>The <span style='color:darkblue'><strong>CHEAPEST</span> book costs: <span style='color:darkblue'><strong>$" . number_format((float)$record['min(price)'], 2, '.', '') . "</strong></span></h3>";
}

function getAveragePriceDB(){
    
    
    global $conn;
    $sql="SELECT avg(price) FROM book";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $record = $statement->fetch(PDO::FETCH_ASSOC);
    
    echo "<h3>The <span style='color:darkblue'><strong>AVERAGE</span> price for the books in the DB is: <span style='color:darkblue'><strong>" . number_format((float)$record['avg(price)'], 2, '.', '') . "</strong></span></h3>";
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title> CSUMB Shop - Report Center </title>
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
        
        <script>
            function confirmDelete(){
                return confirm("Are you sure you want to delete it?")
            }
        </script>
    </head>
    <body>
        <div class="container">
            <div class="jumbotron">
                <div class="container text-center">
                <h1>Report Center</h1>      
                  <p>Here you can generate reports about the data in the DB by using aggregate functions. </p>
                </div>
        </div>
        
        <div class="container">
            <div class="row">
            <div class="col-md-4">
            <div id="sidebar" class="well sidebar-nav">
                <h5><i class="glyphicon glyphicon-user"></i>
                    <small><b>USERS</b></small>
                    <h5> Welcome <?=$_SESSION['adminName']?>! </h5>
                </h5>
                 <br />
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="admin.php"><span class="glyphicon glyphicon-th"></span> Back to Panel</a></li>
                    <li class="active"><a href="report.php"> <span class="glyphicon glyphicon-list-alt"></span> Report</a></li>
                </ul>
                

            </div>
        </div>
        <div class="col-md-8">
           <?php 
                countHowManyBooks();
                echo "<br>";
                getMaximumBookPrice();
                echo "<br>";
                getMinimumBookPrice();
                echo "<br>";
                getAveragePriceDB();
            ?>
        </div>
    </div>
</div>
    </body>
</html>

