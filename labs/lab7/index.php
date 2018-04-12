<?php

    session_start();

    //print_r($_POST);  //displays values passed in the form
    
    include '../../dbConnection.php';
    
    $conn = getDatabaseConnection("heroku_aa693a7a56d9950");
    
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    
    
    
    //echo $password;
    
    
    //following sql does not prevent SQL injection
    // $sql = "SELECT * 
    //         FROM om_admin
    //         WHERE username = '$username'
    //         AND   password = '$password'";
            
    //following sql prevents sql injection by avoiding using single quotes        
    $sql = "SELECT * 
            FROM om_admin
            WHERE username = :username
            AND   password = :password";    
            
    $np = array();
    $np[":username"] = $username;
    $np[":password"] = $password;
    
            
    $stmt = $conn->prepare($sql);
    $stmt->execute($np);
    $record = $stmt->fetch(PDO::FETCH_ASSOC); //expecting one single record
    
    //print_r($record);
    
?>


<!DOCTYPE html>
<html>
    <head>
        <title> Admin Login </title>
        <link href="css/styles.css" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
    
    </head>
    <body>
        
        <h1> OtterMart - Admin Login </h1>
        
        <form method="POST">
            
            Username: <input type="text" name="username" placeholder="Enter your username"/> <br />
            Password: <input type="password" name="password" placeholder="Enter your password"/> <br /> 
            
            <input type="submit" name="submitForm" value="Login"/> 
        </form>
        
        <?php
        
            if(isset($_POST['submitForm'])){
            
                if(empty($_POST['username'])){
                    echo "<h5 style='color:red;'> * Username field cannot be empty!</h5>";
                }
                if(empty($_POST['password'])){
                    echo "<h5 style='color:red;'> * Password field cannot be empty!</h5>";
                }
        
                if (empty($record)) {
                    
                    echo "<h4 style='color:red;'> * Wrong username or password!</h4>";
 
                } 
                else {
                        //echo $record['firstName'] . " " . $record['lastName'];
                        $_SESSION['adminName'] = $record['firstName'] . " " . $record['lastName'];
                        header("Location:admin.php");
                }
            
            }
            
        
        ?>

    </body>

	    CST 336 Internet Programming &copy;Lab 7
		<img style="width:100px" src="img/buddy_verified.png" alt="Buddy" />
</html>