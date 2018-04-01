<?php

session_start(); // START SESSION

print_r($_SESSION); // PRINT SESSION

$_SESSION['start_time'] = time(); // 
$end_time = time();
$end_time - $_SESSION['start_time'] = 65 //seconds (divide by 60 to get minutes)

?>

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
    </head>
    <body>
        <h2>My favorite class is <?= $_SESSION['course'] ?></h2>

    </body>
</html>