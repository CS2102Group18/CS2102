<?php
    function styleTable() {
        echo "<style>td{text-align: center;}</style>";
    }

    function displayTableProject($db) {
        $result = pg_query($db, "SELECT * FROM project");	
        $col1 = NULL;
        $col2 = NULL;
        $col3 = NULL;
        echo "<b>TABLE project</b>";
        echo "<table id='table'>";
        echo "<tr>";
        echo "<th>id</th>";
        echo "<th>title</th>";
        echo "<th>description</th>";
        echo "</tr>";
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
    }
    
    function displayTableInvest($db) {
        $result = pg_query($db, "SELECT * FROM invest");	
        $col1 = NULL;
        $col2 = NULL;
        $col3 = NULL;
        echo "<b>TABLE invest</b>";
        echo "<table id='table'>";
        echo "<tr>";
        echo "<th>investor</th>";
        echo "<th>proj_id</th>";
        echo "<th>amount</th>";
        echo "</tr>";
        while ($row = pg_fetch_assoc($result)) {
            $text1 = '';
            $text2 = '';
            $text3 = '';
            if ($row['investor'] != $col1 ||
                $row['proj_id'] != $col2 ||
                $row['amount'] != $col3) {
                $col1 = $row['investor'];
                $col2 = $row['proj_id'];
                $col3 = $row['amount'];
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
    }
    
    function displayTableAdvertise($db) {
        $result = pg_query($db, "SELECT * FROM advertise");	
        $col1 = NULL;
        $col2 = NULL;
        $col3 = NULL;
        $col4 = NULL;
        echo "<b>TABLE advertise</b>";
        echo "<table id='table'>";
        echo "<tr>";
        echo "<th>entrepreneur</th>";
        echo "<th>proj_id</th>";
        echo "<th>amt_needed</th>";
        echo "<th>amt_raised</th>";
        echo "</tr>";
        while ($row = pg_fetch_assoc($result)) {
            $text1 = '';
            $text2 = '';
            $text3 = '';
            $text4 = '';
            
            if ($row['entrepreneur'] != $col1 ||
                $row['proj_id'] != $col2 ||
                $row['amt_needed'] != $col3 ||
                $row['amt_raised'] != $col4) {
                $col1 = $row['entrepreneur'];
                $col2 = $row['proj_id'];
                $col3 = $row['amt_needed'];
                $col4 = $row['amt_raised'];
                $text1 = $col1;
                $text2 = $col2;
                $text3 = $col3;
                $text4 = $col4;
            }
            echo "<tr>";
            echo "<td align='left' width='200'>" . $text1 . "</td>";
            echo "<td align='left' width='350'>" . $text2 . "</td>";
            echo "<td align='left' width='350'>" . $text3 . "</td>";
            echo "<td align='left' width='350'>" . $text4 . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    include '../../php/deleteInvest.php';
	// Connect to the database. Please change the password in the following line accordingly
    $db = pg_connect("host=localhost port=5432 dbname=cs2102 user=postgres password=group18@CS2102");
	
	// Delete all tables from database - a clean start
	$clear_database = file_get_contents('../sql/dropTable.sql', true);
	$database_cleaning_result = pg_query($db, $clear_database);
	
	// Create table in database
	$table_schema = file_get_contents('../sql/createTableSchema.sql', true);
	$table_creation_result = pg_query($db, $table_schema);
    
    // Insert members
    pg_query($db, "INSERT INTO member(username, password) VALUES('Naruto', '12r42345f')");
    pg_query($db, "INSERT INTO member(username, password) VALUES('Sasuke', 'wg453g25')");
    pg_query($db, "INSERT INTO member(username, password) VALUES('Sakura', 'qwe342b')");
    pg_query($db, "INSERT INTO member(username, password) VALUES('Ino', 'u45b3456h')");
    pg_query($db, "INSERT INTO member(username, password) VALUES('Shikamaru', 'g3423g45')");
    
    // Insert projects
    pg_query($db, "INSERT INTO project(id, title, description, category) VALUES(1, 'Chasing a girl named Sakura', 'A quest that Naruto sets out for', 'Community')");
    pg_query($db, "INSERT INTO project(id, title, description, category) VALUES(2, 'A Rogue Ninja', 'Sasuke finding his own identity', 'Games')");
    
    // Insert advertisement
    pg_query($db, "INSERT INTO advertise (entrepreneur, proj_id, amt_needed) VALUES ('Naruto', 1, 200)");
    pg_query($db, "INSERT INTO advertise (entrepreneur, proj_id, amt_needed) VALUES ('Sasuke', 2, 100)");
    
    // Insert investments
    pg_query($db, "INSERT INTO invest (investor, proj_id, amount) VALUES ('Ino', 1, 100)");
    pg_query($db, "INSERT INTO invest (investor, proj_id, amount) VALUES ('Shikamaru', 1, 50)");
    pg_query($db, "INSERT INTO invest (investor, proj_id, amount) VALUES ('Sakura', 2, 90)");
    
    styleTable();
    
    echo "<u><b>AFTER INSERTION</b></u>";
    echo "<br>";
    displayTableProject($db);
    echo "<br><br>";
    displayTableAdvertise($db);
    echo "<br><br>";
    displayTableInvest($db);
    echo "<br><br>";
    echo "------------------------------------------------------------------------------------------------------";
    echo "<br><br>";
    
    // Delete the member
    deleteInvest($db, 'Shikamaru', 1);
    
    echo "<u><b>AFTER Deletion</b></u>";
    echo "<br>";
    displayTableProject($db);
    echo "<br><br>";
    displayTableAdvertise($db);
    echo "<br><br>";
    displayTableInvest($db);
    echo "<br><br>";
    
    echo "<br><br>";
    echo "Things to note:";
    echo "<ul>";
    echo "<li>Shikamaru is removed from TABLE invest</li>";
    echo "<li>Amount raised in TABLE advertise is reduced</li>";
    echo "</ul>";
?>  
