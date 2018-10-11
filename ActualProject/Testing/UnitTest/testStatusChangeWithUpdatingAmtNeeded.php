<?php
    include './connectionToDatabase.php';
    include './displayTable.php';
    
    include '../../php/updateAdvertisedProject.php';
    
	$db = getDB();
    
    // Insert members
    pg_query($db, "INSERT INTO member(username, password) VALUES('Naruto', '12r42345f')");
    pg_query($db, "INSERT INTO member(username, password) VALUES('Sasuke', 'wg453g25')");
    pg_query($db, "INSERT INTO member(username, password) VALUES('Sakura', 'qwe342b')");
    pg_query($db, "INSERT INTO member(username, password) VALUES('Ino', 'u45b3456h')");
    pg_query($db, "INSERT INTO member(username, password) VALUES('Shikamaru', 'g3423g45')");
    
    // Insert projects
    pg_query($db, "INSERT INTO advertised_project(entrepreneur, title, description, category, amt_needed) VALUES('Naruto', 'Chasing a girl named Sakura', 'A quest that Naruto sets out for', 'Community', 500)");
    pg_query($db, "INSERT INTO advertised_project(entrepreneur, title, description, category, amt_needed) VALUES('Sasuke', 'A Rogue Ninja', 'Sasuke finding his own identity', 'Games', 100)");
    
    // Insert investments
    pg_query($db, "INSERT INTO invest (investor, proj_id, amount) VALUES ('Ino', 1, 100)");
    pg_query($db, "INSERT INTO invest (investor, proj_id, amount) VALUES ('Shikamaru', 1, 50)");
    pg_query($db, "INSERT INTO invest (investor, proj_id, amount) VALUES ('Sakura', 2, 90)");
    
    styleTable();
    
    echo "<u><b>AFTER INSERTION - Original Tables</b></u>";
    echo "<br>";
    displayTableProject($db);
    echo "<br><br>";
    displayTableInvest($db);
    echo "<br><br>";
    echo "------------------------------------------------------------------------------------------------------";
    echo "<br><br>";
    
    echo "<u><b>AFTER Update</b></u>";
    echo "<br><br>";
    
    // Update amount needed to a lower value than previous amount and is more than current amount raised
    // Expect: status in TABLE advertise is still 0
    updateAmountNeeded($db, 2, 95);
    echo "<u>Action: Changed Project 2's amount needed from 100 to 95</u>"; echo "<br>";
    echo "<i>Explanation: Update investment to a lower value than previously invested and is more than current amount raised</i>";
    echo "<br>";
    displayTableProject($db);
    echo "<br><br>";
    displayTableInvest($db);
    echo "<br><br>";
    echo "Things to note:";
    echo "<ul>";
    echo "<li>Amount needed in Project 2 has changed from 100 to 95</li>";
    echo "<li>Status of Project 2 is still 0</li>";
    echo "</ul>";
    echo "<br><br>";
    echo "------------------------------------------------------------------------------------------------------";
    echo "<br><br>";
    
    // Update amount needed to a lower value than previous amount and same as current amount raised
    // Expect: status in TABLE advertise is changed to 1
    updateAmountNeeded($db, 2, 90);
    echo "<u>Action: Changed Project 2's amount needed from 95 to 90</u>"; echo "<br>";
    echo "<i>Explanation: Update amount needed to a lower value than previous amount and same as current amount raised</i>";
    echo "<br>";
    displayTableProject($db);
    echo "<br><br>";
    displayTableInvest($db);
    echo "<br><br>";
    echo "Things to note:";
    echo "<ul>";
    echo "<li>Amount needed in Project 2 has changed from 95 to 90</li>";
    echo "<li>Status of Project 2 is now 1</li>";
    echo "</ul>";
    echo "<br><br>";
    echo "------------------------------------------------------------------------------------------------------";
    echo "<br><br>";
    
    echo "<u>Action: Change Project 2's amount needed to below 90</u>"; echo "<br>";
    echo "<i>Explanation: new row for relation 'advertise' violates check constraint 'advertise_check'</i>";
    echo "<br><br>";
    echo "------------------------------------------------------------------------------------------------------";
    echo "<br><br>";
    
    // Update amount needed to above amount raised
    // Expect: status in TABLE advertise becomes 0
    updateAmountNeeded($db, 2, 500);
    echo "<u>Action: Changed Project 2's amount needed from 90 to 500</u>"; echo "<br>";
    echo "<i>Explanation: Update amount needed to above amount raised</i>";
    echo "<br>";
    displayTableProject($db);
    echo "<br><br>";
    displayTableInvest($db);
    echo "<br><br>";
    echo "Things to note:";
    echo "<ul>";
    echo "<li>Amount needed in Project 2 has changed from 90 to 500</li>";
    echo "<li>Status of Project 2 becomes 0</li>";
    echo "</ul>";
    echo "<br><br>";
    echo "------------------------------------------------------------------------------------------------------";
    echo "<br><br>";
?>  
