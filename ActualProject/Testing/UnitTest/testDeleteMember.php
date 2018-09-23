<?php
    include './displayTable.php';

    include '../../php/deleteMember.php';
	// Connect to the database. Please change the password in the following line accordingly
    $db = pg_connect("host=localhost port=5432 dbname=cs2102 user=postgres password=group18@CS2102");
	
	// Delete all tables from database - a clean start
	$clear_database = file_get_contents('../sql/dropTable.sql', true);
	$database_cleaning_result = pg_query($db, $clear_database);
	
	// Create table in database
	$table_schema = file_get_contents('../sql/createTableSchema.sql', true);
	$table_creation_result = pg_query($db, $table_schema);
    
    // Insert a member
    pg_query($db, "INSERT INTO member(username, password) VALUES('Naruto', '12r42345f')");
    pg_query($db, "INSERT INTO member(username, password) VALUES('Saskuke', 'wg453g25')");
    
    styleTable();
    
    echo "<u><b>AFTER INSERTION</b></u>";
    echo "<br>";
    displayTableMember($db);
    echo "<br><br>";
    echo "------------------------------------------------------------------------------------------------------";
    echo "<br><br>";
    
    
    // Delete the member
    $result_deletion = pg_query($db, deleteMember($db, 'Naruto'));
    
    echo "<u><b>AFTER Deletion</b></u>";
    echo "<br>";
    displayTableMember($db);
    echo "<br><br>";
    
    echo "<br><br>";
    echo "Things to note:";
    echo "<ul>";
    echo "<li>Naruto is removed from the table</li>";
    echo "</ul>";
?>  
