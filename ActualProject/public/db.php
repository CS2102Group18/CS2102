<?php
	$db = pg_connect("host=localhost port=5432 dbname=cs2102 user=postgres password=group18@CS2102");
	if(!$db){
		die("Connection Failed");
	}
?>
