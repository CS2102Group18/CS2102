<?php
    include './connectionToDatabase.php';
    include './displayTable.php';

    include '../../php/member.php';

    $db = getDB();
    
    // Insert a member
    pg_query($db, "INSERT INTO member(username, password) VALUES('Naruto', '12r42345f')");
    pg_query($db, "INSERT INTO member(username, password) VALUES('Saskuke', 'wg453g25')");
    pg_query($db, "INSERT INTO member(username, password, email) VALUES('Kakashi', 'g4bv454t34', 'kakashi@leafvillage.com')");
    
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
