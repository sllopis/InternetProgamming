<?php
include '../dbConnection.php';
$conn = getDatabaseConnection("library");

$book_name = $_POST['book_name'];
$sql = "select bookName from book where bookName LIKE '$book_name%'";

$stmt = $conn->prepare($sql);
$stmt->execute($np);
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($records as $record) { 
    echo $record['bookName'];
    echo "<br>";

}

?>