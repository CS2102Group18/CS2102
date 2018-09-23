<?php
	$conn = pg_connect("host=localhost port=5432 dbname=cs2102 user=postgres password=group18@CS2102");
	if(!$conn){
		die("Connection Failed");
	}
?>
