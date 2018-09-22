<?php
    include '../../php/deleteProject.php';
	// Connect to the database. Please change the password in the following line accordingly
    $db = pg_connect("host=localhost port=5432 dbname=cs2102 user=postgres password=group18@CS2102");
	
	// Delete all tables from database - a clean start
	$clear_database = file_get_contents('../sql/dropTable.sql', true);
	$database_cleaning_result = pg_query($db, $clear_database);
	
	// Create table in database
	$table_schema = file_get_contents('../sql/createTableSchema.sql', true);
	$table_creation_result = pg_query($db, $table_schema);
    
    // Insert a project
    pg_query($db, "INSERT INTO project(id, title, description, category) VALUES(1, 'Chasing a girl named Sakura', 'A quest that Naruto sets out for', 'Community')");
    pg_query($db, "INSERT INTO project(id, title, description, category) VALUES(2, 'A Rogue Ninja', 'Sasuke finding his own identity', 'Games')");
    
    $result = pg_query($db, "SELECT * FROM project");	
    $col1 = NULL;
    $col2 = NULL;
    $col3 = NULL;
    echo "<u><b>AFTER INSERTION</b></u>";
    echo "<table id='table'>";
    while ($row = pg_fetch_assoc($result)) {
        $text1 = '';
        $text2 = '';
        $text3 = '';
        if ($row['id'] != $col1 ||
            $row['title'] != $col2 ||
            $row['description'] != $col3) {
            $col1 = $row['id'];
            $col2 = $row['title'];
            $col3 = $row['description'];
            $text1 = $col1;
            $text2 = $col2;
            $text3 = $col3;
        }
        echo "<tr>";
        echo "<td align='left' width='200'>" . $text1 . "</td>";
        echo "<td align='left' width='350'>" . $text2 . "</td>";
        echo "<td align='left' width='350'>" . $text3 . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    
    // Delete the member
    $result_deletion = pg_query($db, deleteProject($db, 1));
    
    $result = pg_query($db, "SELECT * FROM project");	
    $col1 = NULL;
    $col2 = NULL;
    $col3 = NULL;
    echo "<u><b>AFTER DELETION</b></u>";
    echo "<table id='table'>";
    while ($row = pg_fetch_assoc($result)) {
        $text1 = '';
        $text2 = '';
        $text3 = '';
        if ($row['id'] != $col1 ||
            $row['title'] != $col2 ||
            $row['description'] != $col3) {
            $col1 = $row['id'];
            $col2 = $row['title'];
            $col3 = $row['description'];
            $text1 = $col1;
            $text2 = $col2;
            $text3 = $col3;
        }
        echo "<tr>";
        echo "<td align='left' width='200'>" . $text1 . "</td>";
        echo "<td align='left' width='350'>" . $text2 . "</td>";
        echo "<td align='left' width='350'>" . $text3 . "</td>";
        echo "</tr>";
    }
    echo "</table>";
?>  
