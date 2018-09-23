<?php
    include './connectionToDatabase.php';
    include './displayTable.php';

    include '../../php/deleteProject.php';
	
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
    
    
    // Delete the member
    $result_deletion = pg_query($db, deleteProject($db, 1));
    
    echo "<u><b>AFTER Deletion</b></u>";
    echo "<br>";
    displayTableProject($db);
    echo "<br><br>";
    
    echo "<br><br>";
    echo "Things to note:";
    echo "<ul>";
    echo "<li>Project with id=1 is removed from the table</li>";
    echo "</ul>";
?>  
