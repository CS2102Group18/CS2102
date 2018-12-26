<?php
	$db = pg_connect("host=ec2-54-204-40-248.compute-1.amazonaws.com port=5432 dbname=d84j7prebf63e user=eafwccpxtruzkx password=8a3301c5a154fd83bfe23feb1524ad04f92c6363bdbc81734116da653ab4be8a");
	if(!$db){
		die("Connection Failed");
	}
?>
