<!DOCTYPE html>
<style>
* {
    box-sizing: border-box;
}

.col {
    float: left;
    width: 50%;
    padding: 10px;
}

.row:after {
    content: "";
    display: table;
    clear: both;
}
</style>

<head>
  <title>UPDATE PostgreSQL data with PHP</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style>li {list-style: none;}</style>
</head>
<body>
  <h2>Supply bookid and enter</h2>
  <div class="row">
	<div class="col">
	  <ul>
		<form name="display" action="index.php" method="POST" >
		  <li>Book ID:</li>
		  <li><input type="text" name="bookid" /></li>
		  <li><input type="submit" name="submit" /></li>
		</form>
	  </ul>
	</div>
	<div class="col">
	  <ul>
		<form name="display" action="index.php" method="POST" >
			<li>Book ID to Delete:</li>
			<li><input type="text" name="bookidToDoDeleteText" /></li>
			<li><input type="submit" name="bookidToDelete" value = "Delete" /></li>
		</form>
	  </ul>
	 </div>
  </div>
  <?php
  	// Connect to the database. Please change the password in the following line accordingly
    $db     = pg_connect("host=localhost port=5432 dbname=Project1 user=postgres password=group18@CS2102");	
    $result = pg_query($db, "SELECT * FROM book where book_id = '$_POST[bookid]'");		// Query template
    $row    = pg_fetch_assoc($result);		// To store the result row
	if (isset($_POST['submit'])) {
        echo "<ul><form name='update' action='index.php' method='POST' >  
    	<li>Book ID:</li>  
    	<li><input type='text' name='bookid_updated' value='$row[book_id]' /></li>  
    	<li>Book Name:</li>  
    	<li><input type='text' name='book_name_updated' value='$row[name]' /></li>  
    	<li>Price (USD):</li><li><input type='text' name='price_updated' value='$row[price]' /></li>  
    	<li>Date of publication:</li>  
    	<li><input type='text' name='dop_updated' value='$row[date_of_publication]' /></li>  
    	<li><input type='submit' name='new' /></li>  
    	</form>  
    	</ul>";
    }
   if (isset($_POST['new'])) {	// Submit the update SQL command
	   $result1 = pg_query($db, "SELECT * FROM book where book_id = '$_POST[bookid_updated]'");
       $rows = pg_num_rows($result1);
	   echo "$rows";
		if($rows > 0){
			$result = pg_query($db, "UPDATE book SET book_id = '$_POST[bookid_updated]',  
			name = '$_POST[book_name_updated]',price = '$_POST[price_updated]',  
			date_of_publication = '$_POST[dop_updated]' where book_id = '$_POST[bookid_updated]'");
			echo "Updating Row";
		} else {
			$result = pg_query($db, "INSERT INTO book(book_id,name,price,date_of_publication) VALUES ('$_POST[bookid_updated]',  
			'$_POST[book_name_updated]','$_POST[price_updated]',  
			'$_POST[dop_updated]')");		
			echo "Inserting Row";
		}
		if (!$result) {
			echo "Update failed!!";
		} else {
			echo "Update successful!";
		}
    }
	if (isset($_POST["bookidToDelete"])) { //Delete SQL Command
		$bookidDeleted = $_POST[bookidToDoDeleteText];
		
		echo "bookid is : ". $bookidDeleted ,"\n";
		
		$resultDeleted = pg_query($db, "DELETE FROM book WHERE book_id = '$bookidDeleted'");
		
		if (!$resultDeleted) {
            echo "Delete Failed!";
        } else {
            echo "Delete Success!";
        }
	}
    ?>  
</body>
</html>
