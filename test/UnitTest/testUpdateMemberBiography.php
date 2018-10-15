<?php
    include './connectionToDatabase.php';
    include './displayTable.php';

    include '../../php/member.php';
    
    $db = getDB();
    
    // Insert members
    pg_query($db, "INSERT INTO member(username, password) VALUES('Naruto', '12r42345f')");
    pg_query($db, "INSERT INTO member(username, password, biography) VALUES('Sasuke', 'wg453g25', 'I love Sakura')");
    pg_query($db, "INSERT INTO member(username, password, biography) VALUES('Shikamaru', 't14g3f4ge', 'I have a friend called Naruto')");
    
    styleTable();
    
    echo "<u><b>AFTER INSERTION</b></u>";
    echo "<br>";
    displayTableMember($db);
    echo "<br><br>";
    echo "------------------------------------------------------------------------------------------------------";
    echo "<br><br>";
    
    
    // Update member biography
    $result = pg_query($db, updateBiography($db, 'Shikamaru', 'I am part of the Shika-Ino-Cho Team'));
    
    echo "<u><b>AFTER updating</b></u>";
    echo "<br>";
    displayTableMember($db);
    echo "<br><br>";
    
    echo "<br><br>";
    echo "Things to note:";
    echo "<ul>";
    echo "<li>The biography of Shikamaru will change from 'I have a friend called Naruto' to 'I am part of the Shika-Ino-Cho Team'</li>";
    echo "</ul>";
?>  
