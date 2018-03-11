<?php

// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = $gpaErr = $majorErr = "";
$name = $email = $gender = $comment = $website = $gpa = $major = "";

global $majorErr, $nameErr, $genderErr, $gpaErr, $emailErr;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed"; 
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
    }
  }
    
  if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = test_input($_POST["website"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
      $websiteErr = "Invalid URL"; 
    }
  }
  
   if (empty($_POST["major"])) {
    $majorErr = "Major is required";
  } else {
    $major = test_input($_POST["major"]);
    // check if major only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$major)) {
      $majorErr = "Only letters and white space allowed"; 
    }
  }

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }
  
   if (empty($_POST["gpa"])) {
    $gpaErr = "GPA is required";
  } else {
    $gpa = test_input($_POST["gpa"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function displayACK(){
    
    global $name, $email, $website, $comment, $gender, $gpa, $major;
   
    echo "<div id='input'><h2>Thank you for taking the survey <strong style='color:gold;'>$name</strong> !</h2>
    <h4>We shall now double check the information entered. </h4> <br><br>
    Your name is: <p id='response'<strong>$name</strong></p> <br>
    Your email is: <p id='response'<strong>$email</strong></p> <br>
    Your University website is <u>(optional)</u>:<p id='response'<strong>$website</strong></p><br>
    Your major is: <p id='response'<strong>$major</strong><p> <br> 
    Your comment is <u>(optional)</u>: <p id='response'<strong>$comment</strong></p> <br>
    Your GPA is: <p id='response'<strong>$gpa</strong></p> <br>
    Your gender is: <p id='response'<strong>$gender</strong></p><br></div>";
  }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>CSUMB - Official Survey</title>
        
        <link href="css/styles.css" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
    </head>
    <body>
            <?php include "index.php"; 
                
                if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['website'])
                && isset($_POST['comment']) && isset($_POST['gender']) && isset($_POST['gpa'])
                && isset($_POST['major']) && !empty($_POST['name']) && !empty($_POST['email'])
                && !empty($_POST['major']) && !empty($_POST['gpa']) && !empty($_POST['gender'])
                && strcmp($genderErr,"Gender is required") && strcmp($gpaErr,"GPA is required")
                && strcmp($majorErr,"Major is required") && strcmp($majorErr,"Only letters and white space allowed")
                && strcmp($emailErr,"Email is required") && strcmp($websiteErr,"Invalid URL") 
                && strcmp($emailErr,"Invalid email format") && strcmp($nameErr,"Name is required") 
                && strcmp($nameErr,"Only letters and white space allowed")){
                    displayACK(); // if form was submitted, then display information.
                }
                else{
                  // do nothing (don't display results).
                }
            ?>
  </body>
</html>
