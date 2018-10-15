<?php
    include './connectionToDatabase.php';
    include './displayTable.php';

    include '../../php/project.php';
    include '../../php/search.php';
    
    $db = getDB();
    
    // Insert members
    pg_query($db, "INSERT INTO member(username, password) VALUES('Mitsuki', '12r42345f')");
    pg_query($db, "INSERT INTO member(username, password) VALUES('Shikadai', 'wg453g25')");
    pg_query($db, "INSERT INTO member(username, password) VALUES('Boruto', 'fqwef32f')");
    pg_query($db, "INSERT INTO member(username, password) VALUES('Chocho', 'h45g33')");
    pg_query($db, "INSERT INTO member(username, password) VALUES('Iwabe', 'bvwv5g54')");
    
    // Insert projects
    pg_query($db, "INSERT INTO advertised_project(entrepreneur, title, description, category, duration, amt_needed) VALUES('Mitsuki', 'What is my real will?', 'A journey to discover who is the real he.', 'Community', '10', 500)");
    pg_query($db, "INSERT INTO advertised_project(entrepreneur, title, description, category, duration, amt_needed) VALUES('Shikadai', 'What is intelligence', 'I make the best decision', 'Community', '200', 1000)");
    pg_query($db, "INSERT INTO advertised_project(entrepreneur, title, description, category, duration, amt_needed) VALUES('Shikadai', 'We will figure this out', 'I make the best decision. Woohoo!', 'Games', '200', 1000)");
    pg_query($db, "INSERT INTO advertised_project(entrepreneur, title, description, category, duration, amt_needed) VALUES('Boruto', 'Fighting crime, trying to save the world', 'Just follow your nindo', 'Fashion', '50', 20)");
    pg_query($db, "INSERT INTO advertised_project(entrepreneur, title, description, category, duration, amt_needed) VALUES('Chocho', 'Eating is the best thing in this world', 'Potato chips are my favourite', 'Food', '2040', 888)");
    pg_query($db, "INSERT INTO advertised_project(entrepreneur, title, description, category, duration, amt_needed) VALUES('Iwabe', 'Rock and roll!', 'Woohoo!', 'Games', '20', 1000)");
    pg_query($db, "INSERT INTO advertised_project(entrepreneur, title, description, category, duration, amt_needed) VALUES('Iwabe', 'We shall be the best ninja, right Boruto?', 'Yatta!', 'Fashion', '200', 1000)");
    
    styleTable();
    
    echo "<u><b>AFTER INSERTION</b></u>";
    echo "<br>";
    displayTableProject($db);
    echo "<br><br>";
    echo "------------------------------------------------------------------------------------------------------------------------------------------------";
    echo "<br><br>";
    
    // Search by title and filter by category
    $text = "What is";
    $category = "Community";
	$result = searchProject($db, $category, $text);
    
    echo "<u><b>Search by title filter by category</b></u><br>";
    echo "Search='$text' && Category='$category'";
    echo "<br>";

    displayResult($db, $result);
    
    echo "<br><br>";
    echo "Things to expect:";
    echo "<ul>";
    echo "<li>Should contain 2 rows</li>";
    echo "<li>One row with project advertised by Mitsuki</li>";
    echo "<li>One row with project advertised by Shikadai</li>";
    echo "</ul>";
    echo "<br><br>";
    echo "------------------------------------------------------------------------------------------------------------------------------------------------";
    echo "<br><br>";
    
    // Search by description and filter by category
    $text = "Woohoo";
    $category = "Games";
	$result = searchProject($db, $category, $text);
    
    echo "<u><b>Search by description filter by category</b></u><br>";
    echo "Search='$text' && Category='$category'";
    echo "<br>";
   
    displayResult($db, $result);
    
    echo "<br><br>";
    echo "Things to note:";
    echo "<ul>";
    echo "<li>Should contain 2 rows</li>";
    echo "<li>One row with project advertised by Shikadai</li>";
    echo "<li>One row with project advertised by Iwabe</li>";
    echo "</ul>";
    echo "<br><br>";
    echo "------------------------------------------------------------------------------------------------------------------------------------------------";
    echo "<br><br>";
    
    // Search by entrepreneur and filter by category
    $text = "Chocho";
    $category = "Food";
	$result = searchProject($db, $category, $text);
    
    echo "<u><b>Search by entrepreneur filter by category</b></u><br>";
    echo "Search='$text' && Category='$category'";
    echo "<br>";

    displayResult($db, $result);
    
    echo "<br><br>";
    echo "Things to expect:";
    echo "<ul>";
    echo "<li>Should only display 1 row containing project advertised by ChoCho</li>";
    echo "</ul>";
    echo "<br><br>";
    echo "------------------------------------------------------------------------------------------------------------------------------------------------";
    echo "<br><br>";
    
    // Search text and filter by category
    $text = "Boruto";
    $category = "Fashion";
	$result = searchProject($db, $category, $text);
    
    echo "<u><b>Search text that appear in both title and entrepreneur by category</b></u><br>";
    echo "Search='$text' && Category='$category'";
    echo "<br>";

    displayResult($db, $result);
    
    echo "<br><br>";
    echo "Things to expect:";
    echo "<ul>";
    echo "<li>Should contain 2 rows</li>";
    echo "<li>One row with project advertised by Boruto</li>";
    echo "<li>One row with project advertised by Iwabe</li>";
    echo "<li>This is because 'Boruto' appears in the title of the project, as well as the username of an entrepreneur</li>";
    echo "</ul>";
    echo "<br><br>";
    
    
    function displayResult($db, $result) {
        $col1 = NULL;
        $col2 = NULL;
        $col3 = NULL;
        $col4 = NULL;
        $col5 = NULL;
        $col6 = NULL;
        $col7 = NULL;
        $col8 = NULL;
        $col9 = NULL;
        $col10 = NULL;
        echo "<b>TABLE advertised_project</b>";
        echo "<table id='table'>";
        echo "<tr>";
        echo "<th>id</th>";
        echo "<th>entrepreneur</th>";
        echo "<th>title</th>";
        echo "<th>description</th>";
        echo "<th>category</th>";
        echo "<th>start_date</th>";
        echo "<th>duration</th>";
        echo "<th>amt_needed</th>";
        echo "<th>amt_raised</th>";
        echo "<th>status</th>";
        echo "</tr>";
        while ($row = pg_fetch_assoc($result)) {
            $text1 = '';
            $text2 = '';
            $text3 = '';
            $text4 = '';
            $text5 = '';
            $text6 = '';
            $text7 = '';
            $text8 = '';
            $text9 = '';
            $text10 = '';
            if ($row['id'] != $col1 ||
                $row['entrepreneur'] != $col2 ||
                $row['title'] != $col3 ||
                $row['description'] != $col4 ||
                $row['category'] != $col5 ||
                $row['start_date'] != $col6 ||
                $row['duration'] != $col7 ||
                $row['amt_needed'] != $col8 ||
                $row['amt_raised'] != $col9 ||
                $row['status'] != $col10) {
                $col1 = $row['id'];
                $col2 = $row['entrepreneur'];
                $col3 = $row['title'];
                $col4 = $row['description'];
                $col5 = $row['category'];
                $col6 = $row['start_date'];
                $col7 = $row['duration'];
                $col8 = $row['amt_needed'];
                $col9 = $row['amt_raised'];
                $col10 = $row['status'];
                $text1 = $col1;
                $text2 = $col2;
                $text3 = $col3;
                $text4 = $col4;
                $text5 = $col5;
                $text6 = $col6;
                $text7 = $col7;
                $text8 = $col8;
                $text9 = $col9;
                $text10 = $col10;
            }

            echo "<tr>";
            echo "<td align='center' width='50'>" . $text1 . "</td>";
            echo "<td align='center' width='150'>" . $text2 . "</td>";
            echo "<td align='center' width='250'>" . $text3 . "</td>";
            echo "<td align='center' width='350'>" . $text4 . "</td>";
            echo "<td align='center' width='150'>" . $text5 . "</td>";
            echo "<td align='center' width='150'>" . $text6 . "</td>";
            echo "<td align='center' width='150'>" . $text7 . "</td>";
            echo "<td align='center' width='150'>" . $text8 . "</td>";
            echo "<td align='center' width='150'>" . $text9 . "</td>";
            echo "<td align='center' width='50'>" . $text10 . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
?>  
