<?php
    include './connectionToDatabase.php';
    include './displayTable.php';

    include '../../php/member.php';
    
    $db = getDB();
    
    // Insert members
    pg_query($db, "INSERT INTO member(username, password, is_admin) VALUES('Naruto', '12r42345f', 1)");
    pg_query($db, "INSERT INTO member(username, password, email) VALUES('Sasuke', 'wg453g25', 'sasuke123@leafvillage.com')");
    pg_query($db, "INSERT INTO member(username, password, email) VALUES('Choji', 't14g3f4ge', 'ilovefood64@konoha.com')");
    
    styleTable();
    
    echo "<u><b>AFTER INSERTION</b></u>";
    echo "<br>";
    displayTableMember($db);
    echo "<br><br>";
    
    $isNarutoAdmin = isMemberAdmin($db, "Naruto") ? "YES" : "NO";
    echo "<p>Naruto is admin: '$isNarutoAdmin'</p><br>";
    $isSasukeAdmin = isMemberAdmin($db, "Sasuke") ? "YES" : "NO";
    echo "<p>Sasuke is admin: '$isSasukeAdmin'</p><br>";
    $isChojiAdmin = isMemberAdmin($db, "Choji") ? "YES" : "NO";
    echo "<p>Choji is admin: '$isChojiAdmin'</p><br>";
    
    echo "<br><br>";
    echo "Things to note:";
    echo "<ul>";
    echo "<li>Naruto is an admin: YES</li>";
    echo "<li>Sasuke is an admin: NO</li>";
    echo "<li>Choji is an admin: NO</li>";
    echo "</ul>";
?>  
