<?php
    include './connectionToDatabase.php';
    include './displayTable.php';

    include '../../php/deleteAdvertise.php';

    $db = getDB();
    
    // Insert members
    pg_query($db, "INSERT INTO member(username, password) VALUES('Naruto', '12r42345f')");
    pg_query($db, "INSERT INTO member(username, password) VALUES('Sasuke', 'wg453g25')");
    pg_query($db, "INSERT INTO member(username, password) VALUES('Sakura', 'qwe342b')");
    pg_query($db, "INSERT INTO member(username, password) VALUES('Ino', 'u45b3456h')");
    pg_query($db, "INSERT INTO member(username, password) VALUES('Shikamaru', 'g3423g45')");
    pg_query($db, "INSERT INTO member(username, password) VALUES('Kakashi', 'bw45yv4356')");
    pg_query($db, "INSERT INTO member(username, password) VALUES('Tsunade', '234gb6bhu6')");
    
    // Insert projects
    pg_query($db, "INSERT INTO project(title, description, category) VALUES('Chasing a girl named Sakura', 'A quest that Naruto sets out for', 'Community')");
    pg_query($db, "INSERT INTO project(title, description, category) VALUES('A Rogue Ninja', 'Sasuke finding his own identity', 'Games')");
    pg_query($db, "INSERT INTO project(title, description, category) VALUES('The Fourth Shinobi War', 'The final showdown', 'Technology')");
    pg_query($db, "INSERT INTO project(title, description, category) VALUES('A New Taste!', 'Ichiraku Ramen Recipe', 'Food')");
    pg_query($db, "INSERT INTO project(title, description, category) VALUES('Largest Gambling Den Opening', 'Will be opened in Leaf Village', 'Community')");
    
    // Insert advertisement
    pg_query($db, "INSERT INTO advertise (entrepreneur, proj_id, amt_needed) VALUES ('Naruto', 1, 200)");
    pg_query($db, "INSERT INTO advertise (entrepreneur, proj_id, amt_needed) VALUES ('Sasuke', 2, 100)");
    pg_query($db, "INSERT INTO advertise (entrepreneur, proj_id, amt_needed) VALUES ('Kakashi', 3, 5000)");
    pg_query($db, "INSERT INTO advertise (entrepreneur, proj_id, amt_needed) VALUES ('Ino', 4, 75)");
    pg_query($db, "INSERT INTO advertise (entrepreneur, proj_id, amt_needed) VALUES ('Tsunade', 5, 1000000)");
    
    // Insert investments
    pg_query($db, "INSERT INTO invest (investor, proj_id, amount) VALUES ('Ino', 1, 100)");
    pg_query($db, "INSERT INTO invest (investor, proj_id, amount) VALUES ('Shikamaru', 1, 50)");
    pg_query($db, "INSERT INTO invest (investor, proj_id, amount) VALUES ('Sakura', 2, 90)");
    pg_query($db, "INSERT INTO invest (investor, proj_id, amount) VALUES ('Naruto', 3, 500)");
    pg_query($db, "INSERT INTO invest (investor, proj_id, amount) VALUES ('Sasuke', 3, 500)");
    pg_query($db, "INSERT INTO invest (investor, proj_id, amount) VALUES ('Naruto', 4, 25)");
    
    styleTable();
    
    echo "<u><b>AFTER INSERTION</b></u>";
    echo "<br>";
    displayTableAdvertise($db);
    echo "<br><br>";
    displayTableInvest($db);
    echo "<br><br>";
    echo "------------------------------------------------------------------------------------------------------";
    echo "<br><br>";
    
    
    // Delete an advertisement with no investment
    deleteAdvertisement($db, 5);
    echo "<u>Action: Delete Project with id=5</u>"; echo "<br>";
    echo "<i>Explanation: Delete an advertisement with no investment</i>";
    echo "<br>";
    displayTableAdvertise($db);
    echo "<br><br>";
    displayTableInvest($db);
    echo "<br><br>";
    echo "Things to note:";
    echo "<ul>";
    echo "<li>Project with id=5 is removed from TABLE advertise</li>";
    echo "<li>Nothing is changed in TABLE invest</li>";
    echo "</ul>";
    echo "<br><br>";
    echo "------------------------------------------------------------------------------------------------------";
    echo "<br><br>";
    
    // Delete an advertisement with only 1 investment
    deleteAdvertisement($db, 2);
    echo "<u>Action: Delete Project with id=2</u>"; echo "<br>";
    echo "<i>Explanation: Delete an advertisement with only 1 investment</i>";
    echo "<br>";
    displayTableAdvertise($db);
    echo "<br><br>";
    displayTableInvest($db);
    echo "<br><br>";
    echo "Things to note:";
    echo "<ul>";
    echo "<li>Project with id=2 is removed from TABLE advertise</li>";
    echo "<li>Project with id=2 is removed from TABLE invest</li>";
    echo "</ul>";
    echo "<br><br>";
    echo "------------------------------------------------------------------------------------------------------";
    echo "<br><br>";
    
    // Delete an advertisement with multiple investment
    deleteAdvertisement($db, 3);
    echo "<u>Action: Delete Project with id=3</u>"; echo "<br>";
    echo "<i>Explanation: Delete an advertisement with multiple investment</i>";
    echo "<br>";
    displayTableAdvertise($db);
    echo "<br><br>";
    displayTableInvest($db);
    echo "<br><br>";
    echo "Things to note:";
    echo "<ul>";
    echo "<li>Project with id=3 is removed from TABLE advertise</li>";
    echo "<li>Project with id=3 is removed from TABLE invest. There is a reduction in the number of records by 2</li>";
    echo "</ul>";
    echo "<br><br>";
?>  
