<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>SilverJack</title>
		
		<link href="css/styles.css" rel="stylesheet" type="text/css" />
		<link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
	
	</head>
	<body>
		<h1 id="title">HARRY POTTER: SILVER JACK</h1>
			
		<div id="content">
			<?php 
				include 'inc/functions.php';
				startGame();
				displayElapsedtime();
				displayWinner();
 			?>
		</div>
		
		<footer>
				CST 336 Internet Programming &copy;Group 10 
			<img src="img/csumb.jpeg" alt="California State University" />
		</footer>
	</body>
</html>

