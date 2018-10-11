<?php
    include './connectionToDatabase.php';
    include './displayTable.php';

    include '../../php/updateAdvertisedProject.php';
    
    $db = getDB();
    
    // Insert members
    pg_query($db, "INSERT INTO member(username, password) VALUES('Naruto', '12r42345f')");
    pg_query($db, "INSERT INTO member(username, password) VALUES('Sasuke', 'wg453g25')");
    
    // Insert projects
    pg_query($db, "INSERT INTO advertised_project(entrepreneur, title, description, category, amt_needed) VALUES('Naruto', 'Chasing a girl named Sakura', 'A quest that Naruto sets out for', 'Community', 500)");
    pg_query($db, "INSERT INTO advertised_project(entrepreneur, title, description, category, amt_needed) VALUES('Sasuke', 'A Rogue Ninja', 'Sasuke finding his own identity', 'Games', 1000)");
    
    styleTable();
    
    echo "<u><b>AFTER INSERTION</b></u>";
    echo "<br>";
    displayTableProject($db);
    echo "<br><br>";
    echo "------------------------------------------------------------------------------------------------------";
    echo "<br><br>";
    
    
    // Update Description
    $result = pg_query($db, updateProjectDescription($db, 1, 'A love story with no happy ending.'));
    
    echo "<u><b>AFTER updating</b></u>";
    echo "<br>";
    displayTableProject($db);
    echo "<br><br>";
    
    echo "<br><br>";
    echo "Things to note:";
    echo "<ul>";
    echo "<li>The description of project with id=1 will change from 'A quest that Naruto sets out for' to 'A love story with no happy ending.'</li>";
    echo "</ul>";
?>  
