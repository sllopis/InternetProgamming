<!DOCTYPE html>
<html>
    <head>
        <title>CSUMB - Official Survey</title>
        
        <link href="css/styles.css" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
    </head>
  
    <body>
        <div id="banner" >
          <img src='img/survey.png' />
        </div>
        
  
<form method="POST" action="functions.php" target="_self">  

  <p><span class="error"><strong>* required field</strong></span></p>
  <label for="name"><b>Name:</b></label>
  <input id="name" type="text" name="name" value="<?php echo $name;?>">
  <span class="error"><b>*</b> <?php echo $nameErr;?></span>
  
  <br><br>
  
  <label for="email"><b>E-mail:</b></label>
  <input id="email" type="text" name="email" value="<?php echo $email;?>">
  <span class="error"><b>*</b> <?php echo $emailErr;?></span>
  
  <br><br>
  
  <label for="website"><b>University Website:</b></label>
  <input id="website" type="text" name="website" value="<?php echo $website;?>">
  <span class="error"><?php echo $websiteErr;?></span>
  
  <br><br>
  
  <label for="major"><b>Your major:</b></label>
  <input id="major" type="text" name="major" value="<?php echo $major;?>">
  <span class="error"><b>*</b> <?php echo $majorErr;?></span>
  
  <br><br>
  
  <label for="comment"><b>Why did you choose this major?</b></label>
  <textarea id="comment" name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
  
  <br><br>
  
  <label for="gpa"><strong>Current GPA:</strong></label>
  <input id="gpa" type="number" value="<?php echo $gpa;?>" name="gpa" step="0.05"min="2.5" max="4" placeholder="2.5">
  <span class="error"><b>*</b> <?php echo $gpaErr;?></span>
  <br><br>
  
  <b>Gender:   </b>
  
  <input id="male" type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">
  <label for="male">Male</label>
  <input id="female" type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">
  <label for="female">Female</label>
  <input id="other" type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">
  <label for="other">Other</label>
  <span class="error"><b>*</b> <?php echo $genderErr;?></span>
  
  <br><br>
  
  <input id="button" type="submit" name="submit" value="Submit"> 
  
</form>

</body>

<footer>
    <p style="color:white">CST 336 Internet Programming &copy;2018. All rights reserved. <br>
                    Sergio Llopis Do&#241ate</p>
                    <img width="100px;" src='img/buddy.png'
</footer>
</html>

