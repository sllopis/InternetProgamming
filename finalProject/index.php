<?php
session_start();

include '../dbConnection.php';
$conn = getDatabaseConnection("library");
//heroku_aa693a7a56d9950
 function displayAuthor(){
        global $conn;
        
        $sql = "SELECT authorID, authorName FROM `author` ORDER BY authorName";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
        foreach ($records as $record) {
            
            echo "<option " . ($_GET["bookAuthor"] == $record["authorID"] ? "selected" : "") .
            " value='".$record["authorID"]."' >" . $record["authorName"] . "</option>";
        }
    }
    
    function displayCategories(){
        global $conn;
        
        $sql = "SELECT catId, catName FROM `category` ORDER BY catName";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
        foreach ($records as $record) {
            
            echo "<option " . ($_GET["bookCategory"] == $record["catId"] ? "selected" : "") .
             " value='".$record["catId"]."' >" . $record["catName"] . "</option>";
            
        }
    }

    function displaySearchResults(){
        global $conn;
        
        if (isset($_GET['searchButton'])) { //checks whether user has submitted the form
            
             echo "<h3>Products Found</h3>";
          
            $sql = "SELECT * FROM book INNER JOIN author a ON book.authorID = a.authorID INNER JOIN category c ON book.categoryID = c.catID WHERE 1 ";
            $catId = "";
            $authorId = "";
            if(!empty($_GET["bookAuthor"])) {
                $authorId = $_GET["bookAuthor"];
                $sql .= " AND book.authorID = $authorId ";
                
            }
            
            if(!empty($_GET["bookCategory"])) {
                $catId = $_GET["bookCategory"];
                $sql .= " AND categoryID = $catId";
            }
            
            if(!empty($_GET["bookName"])) {  
                $bookName = $_GET["bookName"];
                $sql .= " AND bookName LIKE '%$bookName%' ";
            }
   
            $sql .= " ORDER BY bookName " ;
                
            if($_GET["orderBy"] == "desc") {
                            $sql .= " DESC";
            }
        
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(!$records){
                echo "<h4> There are no products under those characteristics. </h4>";
            }
            foreach ($records as $record) { 
                 echo  "<h4>" . "<img style='width:200px' src=" .  $record['bookImage'] . "/><br> <u>". $record["authorName"] . "</u> <strong><br>" . $record["bookName"] . ": </strong><span style='color:brown'>" . " " . $record["bookDescription"] . "</span> <br><span style='color:darkblue'>$" . $record["price"] . "</span></h4><br /> <br>";
            
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
        <title>CSUMB Library - Home Page</title>
    </head>
    <body>

    <div class='container-fluid'>
        <div class='text-center'>
            
            <!-- Bootstrap Navagation Bar -->
            <nav class="navbar navbar-inverse navbar-static-top">
                <ul class="nav navbar-nav">
                  <li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                  <li><a href= "<?php echo (isset( $_SESSION['adminName']))? 'admin.php': 'login.php'; ?>"> <?php echo (isset( $_SESSION['adminName']))? ' Welcome ' . $_SESSION['adminName'] . " " : ' Login '; ?><span class="glyphicon glyphicon-log-in"></span></a></li>
                </ul>
              </div>
            </nav>
            
            <div class="container">
            <div class="jumbotron">
                <div class="container text-center">
                <h1>CSUMB Library</h1>      
                  <p>Welcome to the CSUMB Library, here you can check out our books!</p>
                </div>                
            </div>
    
            <!-- Search Form -->
            <div class="container text-center">
             <form method="GET">
                 
                <div class="form-group">
                    <label for="bookName">Book Name: </label>
                    <input type="text" name="bookName" id="bookName" placeholder="Search Book Title"
                    value="<?= $_GET["bookName"] ?>" onKeyUp="book_suggestion()">
                </div>
                 
                <div class="form-group">
                    <label for="bookName">Book suggestions by Title: </label>
                    <div id="suggestion"></div>
                </div>
                 
                <div class="form-group">
                    <label for="bookCat">Category: </label>
                    <select id="bookCat" name="bookCategory">
                      <option value="" >  Select One </option> 
                      <?php displayCategories(); ?> 
                    </select>
                </div>
    
                <div class="form-group">    
                    <label for="bookAuthor">Author: </label> 
                    <select id="bookAuthor" name="bookAuthor">
                      <option value="" > Select One </option> 
                          <?php displayAuthor(); ?> 
                    </select>
                </div>     
                
                <div class="form-group">     
                     <label for="order">Title is ordered by:</label>
                     <p id="order"></p>
                     <input <?= $_GET["orderBy"] == "asc" ? "checked" : ""; ?> 
                        type="radio" name="orderBy" id = "asc" value = "asc"> <label for="asc"> A-Z</label><br>
                     <input <?= $_GET["orderBy"] == "desc" ? "checked" : ""; ?> 
                         type="radio" name="orderBy" id = "desc" value = "desc"> <label for="desc"> Z-A</label> 
                </div>
                
                <div style="text-align:center" class="container">
                    <input class="btn btn-info btn-rounded" type="submit" name="searchButton" value="Search">
                </div>
    
                </form>
            </div>
	<div class="container text-center">
	    <div class="container">
            <div class="jumbotron">
                <div class="container text-center">
        	    <?php
                    displaySearchResults();
                ?>
            </div>                
        </div>
    </div>
</div>

<script>
//AJAX CALL
    function book_suggestion()
        {
        var book = document.getElementById("bookName").value;
        var xhr;
         if (window.XMLHttpRequest) { // Mozilla, Safari, ...
            xhr = new XMLHttpRequest();
        } else if (window.ActiveXObject) { // IE 8 and older
            xhr = new ActiveXObject("Microsoft.XMLHTTP");
        }
        var data = "book_name=" + book;
             xhr.open("POST", "book-suggestion.php", true); 
             xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                  
             xhr.send(data);
        	 xhr.onreadystatechange = display_data;
        	function display_data() {
        	 if (xhr.readyState == 4) {
                if (xhr.status == 200) {
            	  document.getElementById("suggestion").innerHTML = xhr.responseText;
                }
            }
        }
    }
</script>
    </body>
</html>