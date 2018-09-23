<?php
    include './connectionToDatabase.php';
    include './displayTable.php';

    include '../../php/updateProject.php';
    
    $db = getDB();
    
    // Insert a project
    pg_query($db, "INSERT INTO project(title, description, category) VALUES('Chasing a girl named Sakura', 'A quest that Naruto sets out for', 'Community')");
    pg_query($db, "INSERT INTO project(title, description, category) VALUES('A Rogue Ninja', 'Sasuke finding his own identity', 'Games')");
    
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
