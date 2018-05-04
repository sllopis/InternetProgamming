<?php
    session_start();

    include '../dbConnection.php';
    
    $conn = getDatabaseConnection("heroku_aa693a7a56d9950");
    //heroku_aa693a7a56d9950
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    
    $sql = "SELECT * 
            FROM admin
            WHERE userName = :username
            AND   password = :password";    
            
    $np = array();
    $np[":username"] = $username;
    $np[":password"] = $password;
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($np);
    $record = $stmt->fetch(PDO::FETCH_ASSOC); //expecting one single record
    
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <title>CSUMB Library - Login Page</title>
    </head>
    <body>
        
        
        
    <div class='container-fluid'>
        <div class='text-center'>
            
            <!-- Bootstrap Navagation Bar -->
            <nav class="navbar navbar-inverse">
                <ul class="nav navbar-nav">
                  <li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                  <li class="active"><a href="login.php">Login <span class="glyphicon glyphicon-log-in"></span></a></li>
                </ul>
              </div>
            </nav>
            
            
            <div class="jumbotron">
                <div class="container text-center">
                <h1>Access your account</h1>      
                  <p>Please log-in to access the Database Management Panel. </p>
                </div>
         
            <!-- Search Form -->
            <div class="wrapper">
            
                <form method="POST" class="form-signin">      
                  <h2 style="text-align:center;" class="form-signin-heading">Welcome back!</h2>
                  <input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus="" />
                  <input type="password" class="form-control" name="password" placeholder="Password" required=""/>      
                  <button class="btn btn-lg btn-primary btn-block" name="submitForm" type="submit">Login</button>   
                </form>
            </div>
    </body>
    
    <?php  if(isset($_POST['submitForm'])){
       
        if (empty($record)) {
            echo "<div class='container text-center'><div class='alert alert-danger' style='text-align:center' role='alert'>
                <strong>Wrong username or password!</strong> Please try again.
            </div></div>";
        } else{
            $_SESSION['adminName'] = $record['firstName'];
            header("Location:admin.php");
        }
    } ?>
    
  <!--  <footer>-->
  <!--  <div class="navbar navbar-inverse navbar-static-bottom" role="navigation">-->
  <!--    <div class="container">-->
  <!--      <div class="navbar-header">-->
  <!--      </div>-->
  <!--    </div>-->
  <!--  </div>-->
  <!--</footer>-->
</html>

       
        
       
     

