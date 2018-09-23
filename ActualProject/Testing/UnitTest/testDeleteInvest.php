<?php
    include './connectionToDatabase.php';
    include './displayTable.php';
    
    include '../../php/deleteInvest.php';
	
    $db = getDB();
    
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
    
    echo "<u><b>AFTER INSERTION</b></u>";
    echo "<br>";
    displayTableProject($db);
    echo "<br><br>";
    displayTableAdvertise($db);
    echo "<br><br>";
    displayTableInvest($db);
    echo "<br><br>";
    echo "------------------------------------------------------------------------------------------------------";
    echo "<br><br>";
    
    // Delete the member
    deleteInvest($db, 'Shikamaru', 1);
    
    echo "<u><b>AFTER Deletion</b></u>";
    echo "<br>";
    displayTableProject($db);
    echo "<br><br>";
    displayTableAdvertise($db);
    echo "<br><br>";
    displayTableInvest($db);
    echo "<br><br>";
    
    echo "<br><br>";
    echo "Things to note:";
    echo "<ul>";
    echo "<li>Shikamaru is removed from TABLE invest</li>";
    echo "<li>Amount raised in TABLE advertise is reduced</li>";
    echo "</ul>";
?>  
