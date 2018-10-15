<?php
    include './connectionToDatabase.php';
    include './displayTable.php';

    include '../../php/project.php';
    
    $db = getDB();
    
    // Insert members
    pg_query($db, "INSERT INTO member(username, password) VALUES('Naruto', '12r42345f')");
    pg_query($db, "INSERT INTO member(username, password) VALUES('Sasuke', 'wg453g25')");
    
    // Insert projects
    pg_query($db, "INSERT INTO advertised_project(entrepreneur, title, description, category, duration, amt_needed) VALUES('Naruto', 'Chasing a girl named Sakura', 'A quest that Naruto sets out for', 'Community', '100', 500)");
    pg_query($db, "INSERT INTO advertised_project(entrepreneur, title, description, category, duration, amt_needed) VALUES('Sasuke', 'A Rogue Ninja', 'Sasuke finding his own identity', 'Games', '200', 1000)");
    
    styleTable();
    
    echo "<u><b>AFTER INSERTION</b></u>";
    echo "<br>";
    displayTableProject($db);
    echo "<br><br>";
    echo "------------------------------------------------------------------------------------------------------";
    echo "<br><br>";
    
    
    // Update Title
    $result = pg_query($db, updateProjectTitle($db, 1, 'I will follow my Nindo!'));
    
    echo "<u><b>AFTER updating</b></u>";
    echo "<br>";
    displayTableProject($db);
    echo "<br><br>";
    
    echo "<br><br>";
    echo "Things to note:";
    echo "<ul>";
    echo "<li>The title of project with id=1 will change from 'Chasing a girl named Sakura' to 'I will follow my Nindo!'</li>";
    echo "</ul>";
?>  
