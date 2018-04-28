<?php 

include '../../dbConnection.php';

$conn = getDatabaseConnection("heroku_aa693a7a56d9950");


$username = $_GET['username'];

$sql = "SELECT * FROM lab9_user WHERE username = :username";

$stmt = $conn->prepare($sql);
$stmt->execute(array(":username"=>$username));
$record = $stmt->fetch(PDO::FETCH_ASSOC);

//print_r($record);

echo json_encode($record);


// function addRecord(){
    
//     $sql
    
// }

?>