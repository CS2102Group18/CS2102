<?php
    include '../../php/deleteMember.php';
	// Connect to the database. Please change the password in the following line accordingly
    $db = pg_connect("host=localhost port=5432 dbname=cs2102 user=postgres password=group18@CS2102");
	
	// Delete all tables from database - a clean start
	$clear_database = file_get_contents('../sql/dropTable.sql', true);
	$database_cleaning_result = pg_query($db, $clear_database);
	
	// Create table in database
	$table_schema = file_get_contents('../sql/createTableSchema.sql', true);
	$table_creation_result = pg_query($db, $table_schema);
    
    // Insert a member
    pg_query($db, "INSERT INTO member(username, password) VALUES('Naruto', '12r42345f')");
    pg_query($db, "INSERT INTO member(username, password) VALUES('Saskuke', 'wg453g25')");
    
    $result = pg_query($db, "SELECT * FROM member");	
    $col1 = NULL;
    $col2 = NULL;
    $col3 = NULL;
    echo "<u><b>AFTER INSERTION</b></u>";
    echo "<table id='table'>";
    while ($row = pg_fetch_assoc($result)) {
        $text1 = '';
        $text2 = '';
        $text3 = '';
        if ($row['username'] != $col1 ||
            $row['password'] != $col2 ||
            $row['is_admin'] != $col3) {
            $col1 = $row['username'];
            $col2 = $row['password'];
            $col3 = $row['is_admin'];
            $text1 = $col1;
            $text2 = $col2;
            $text3 = $col3;
        }
        echo "<tr>";
        echo "<td align='left' width='200'>" . $text1 . "</td>";
        echo "<td align='left' width='200'>" . $text2 . "</td>";
        echo "<td align='left' width='200'>" . $text3 . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    
    // Delete the member
    $result_deletion = pg_query($db, deleteMember($db, 'Naruto'));
    
    $result = pg_query($db, "SELECT * FROM member");	
    $col1 = NULL;
    $col2 = NULL;
    $col3 = NULL;
    echo "<u><b>AFTER DELETION</b></u>";
    echo "<table id='table'>";
    while ($row = pg_fetch_assoc($result)) {
        $text1 = '';
        $text2 = '';
        $text3 = '';
        if ($row['username'] != $col1 ||
            $row['password'] != $col2 ||
            $row['is_admin'] != $col3) {
            $col1 = $row['username'];
            $col2 = $row['password'];
            $col3 = $row['is_admin'];
            $text1 = $col1;
            $text2 = $col2;
            $text3 = $col3;
        }
        echo "<tr>";
        echo "<td align='left' width='200'>" . $text1 . "</td>";
        echo "<td align='left' width='200'>" . $text2 . "</td>";
        echo "<td align='left' width='200'>" . $text3 . "</td>";
        echo "</tr>";
    }
    echo "</table>";
?>  
