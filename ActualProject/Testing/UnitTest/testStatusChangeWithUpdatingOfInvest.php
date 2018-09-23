<?php
    include './displayTable.php';
    
    include '../../php/updateInvest.php';
	// Connect to the database.
    $db = pg_connect("host=localhost port=5432 dbname=cs2102 user=postgres password=group18@CS2102");
	
	// Delete all tables from database - a clean start
	$clear_database = file_get_contents('../../sql/dropTable.sql', true);
	$database_cleaning_result = pg_query($db, $clear_database);
	
	// Create table in database
	$table_schema = file_get_contents('../../sql/createTableSchema.sql', true);
	$table_creation_result = pg_query($db, $table_schema);
    
    // Insert members
    pg_query($db, "INSERT INTO member(username, password) VALUES('Naruto', '12r42345f')");
    pg_query($db, "INSERT INTO member(username, password) VALUES('Sasuke', 'wg453g25')");
    pg_query($db, "INSERT INTO member(username, password) VALUES('Sakura', 'qwe342b')");
    pg_query($db, "INSERT INTO member(username, password) VALUES('Ino', 'u45b3456h')");
    pg_query($db, "INSERT INTO member(username, password) VALUES('Shikamaru', 'g3423g45')");
    
    // Insert projects
    pg_query($db, "INSERT INTO project(title, description, category) VALUES('Chasing a girl named Sakura', 'A quest that Naruto sets out for', 'Community')");
    pg_query($db, "INSERT INTO project(title, description, category) VALUES('A Rogue Ninja', 'Sasuke finding his own identity', 'Games')");
    
    // Insert advertisement
    pg_query($db, "INSERT INTO advertise (entrepreneur, proj_id, amt_needed) VALUES ('Naruto', 1, 200)");
    pg_query($db, "INSERT INTO advertise (entrepreneur, proj_id, amt_needed) VALUES ('Sasuke', 2, 100)");
    
    // Insert investments
    pg_query($db, "INSERT INTO invest (investor, proj_id, amount) VALUES ('Ino', 1, 100)");
    pg_query($db, "INSERT INTO invest (investor, proj_id, amount) VALUES ('Shikamaru', 1, 50)");
    pg_query($db, "INSERT INTO invest (investor, proj_id, amount) VALUES ('Sakura', 2, 90)");
    
    styleTable();
    
    echo "<u><b>AFTER INSERTION - Original Tables</b></u>";
    echo "<br>";
    displayTableAdvertise($db);
    echo "<br><br>";
    displayTableInvest($db);
    echo "<br><br>";
    echo "------------------------------------------------------------------------------------------------------";
    echo "<br><br>";
    
    echo "<u><b>AFTER Update</b></u>";
    echo "<br><br>";
    
    // Update investment to a lower value than previously invested
    // Expect: status in TABLE advertise is still 0
    updateInvestmentAmount($db, 'Sakura', 2, 50);
    echo "<u>Action: Changed Sakura's investment from 90 to 50</u>";
    echo "<br>";
    displayTableAdvertise($db);
    echo "<br><br>";
    displayTableInvest($db);
    echo "<br><br>";
    echo "Things to note:";
    echo "<ul>";
    echo "<li>Sakura investment change from 90 to 50 in TABLE invest</li>";
    echo "<li>Status of Project 2 is still 0</li>";
    echo "</ul>";
    echo "<br><br>";
    echo "------------------------------------------------------------------------------------------------------";
    echo "<br><br>";
    
    // Update investment to a higher value than previously invested witch results in max amount raised
    // Expect: status in TABLE advertise is changed to 1
    updateInvestmentAmount($db, 'Sakura', 2, 100);
    echo "<u>Action: Changed Sakura's investment from 50 to 100</u>";
    echo "<br>";
    displayTableAdvertise($db);
    echo "<br><br>";
    displayTableInvest($db);
    echo "<br><br>";
    echo "Things to note:";
    echo "<ul>";
    echo "<li>Sakura investment change from 50 to 100 in TABLE invest</li>";
    echo "<li>Status of Project 2 is now 1</li>";
    echo "</ul>";
    echo "<br><br>";
    echo "------------------------------------------------------------------------------------------------------";
    echo "<br><br>";
    
    // Update investment such that amount_raised in TABLE advertise will not be max
    // Expect: status in TABLE advertise is changed to 0
    updateInvestmentAmount($db, 'Sakura', 2, 20);
    echo "<u>Action: Changed Sakura's investment from 100 to 20</u>";
    echo "<br>";
    displayTableAdvertise($db);
    echo "<br><br>";
    displayTableInvest($db);
    echo "<br><br>";
    echo "Things to note:";
    echo "<ul>";
    echo "<li>Sakura investment change from 100 to 20 in TABLE invest</li>";
    echo "<li>Status of Project 2 is now 0</li>";
    echo "</ul>";
    echo "<br><br>";
?>  
