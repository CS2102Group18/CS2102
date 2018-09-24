<?php
    include './connectionToDatabase.php';
    include './displayTable.php';

    include '../../php/updateMember.php';
    
    $db = getDB();
    
    // Insert members
    pg_query($db, "INSERT INTO member(username, password) VALUES('Naruto', '12r42345f')");
    pg_query($db, "INSERT INTO member(username, password, email) VALUES('Sasuke', 'wg453g25', 'sasuke123@leafvillage.com')");
    pg_query($db, "INSERT INTO member(username, password, email) VALUES('Choji', 't14g3f4ge', 'ilovefood64@konoha.com')");
    
    styleTable();
    
    echo "<u><b>AFTER INSERTION</b></u>";
    echo "<br>";
    displayTableMember($db);
    echo "<br><br>";
    echo "------------------------------------------------------------------------------------------------------";
    echo "<br><br>";
    
    
    // Update member email
    $result = pg_query($db, updateEmail($db, 'Sasuke', 'rogueninja@konoha.com'));
    
    echo "<u><b>AFTER updating</b></u>";
    echo "<br>";
    displayTableMember($db);
    echo "<br><br>";
    
    echo "<br><br>";
    echo "Things to note:";
    echo "<ul>";
    echo "<li>The email of Sasuke will change from sasuke123@leafvillage.com to rogueninja@konoha.com</li>";
    echo "</ul>";
?>  
