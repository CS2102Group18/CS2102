<?php
    include 'connectionToDatabase.php';
    include 'displayTable.php';

    include '../../php/project.php';
    include '../../php/investment.php';
    
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
    
    
    // New invest
    investInProject($db, "Naruto", 2, "100");
    
    echo "<u><b>First Time Investing</b></u>";
    echo "<br>";
    displayTableProject($db);
    echo "<br>";
    displayTableInvest($db);
    echo "<br><br>";
    
    echo "Things to note:";
    echo "<ul>";
    echo "<li>The amt_raised in TABLE advertised_project should have increased from 0 to 100</li>";
    echo "<li>TABLE invest should have a record with Naruto investing 100</li>";
    echo "</ul>";
    echo "<br><br>";
    
    // Update old invest
    investInProject($db, "Naruto", 2, "900");
    
    echo "<u><b>Second Time Investing</b></u>";
    echo "<br>";
    displayTableProject($db);
    echo "<br>";
    displayTableInvest($db);
    echo "<br><br>";
    
    echo "Things to note:";
    echo "<ul>";
    echo "<li>The amt_raised in TABLE advertised_project should have increased from 100 to 1000</li>";
    echo "<li>The status in TABLE advertised_project should have changed from 0 to 1</li>";
    echo "<li>TABLE invest should have a record with Naruto investing 1000</li>";
    echo "</ul>";
    echo "<br><br>";
    
    // Invalid investment
    investInProject($db, "Sasuke", 1, "0");
    $errorMsg = pg_last_error($db);
    
    echo "<u><b>Invalid investment - Invested $0</b></u>";
    echo "<br><br>";
    echo $errorMsg;
    echo "<br><br>";
    displayTableProject($db);
    echo "<br>";
    displayTableInvest($db);
    echo "<br><br>";
    
    echo "Things to note:";
    echo "<ul>";
    echo "<li>There is an error message printed</li>";
    echo "<li>There is no new row added to TABLE invest</li>";
    echo "<li>There should not be any change to the amt_raised in TABLE advertised_project with id=1</li>";
    echo "</ul>";
?>  
