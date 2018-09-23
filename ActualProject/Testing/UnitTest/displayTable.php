<?php
    function styleTable() {
        echo "<style>td{text-align: center;}</style>";
    }
    
    function displayTableMember($db) {
        $result = pg_query($db, "SELECT * FROM member");	
        $col1 = NULL;
        $col2 = NULL;
        $col3 = NULL;
        echo "<b>TABLE member</b>";
        echo "<table id='table'>";
        echo "<tr>";
        echo "<th>username</th>";
        echo "<th>password</th>";
        echo "<th>is_admin</th>";
        echo "</tr>";
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
    }

    function displayTableProject($db) {
        $result = pg_query($db, "SELECT * FROM project");	
        $col1 = NULL;
        $col2 = NULL;
        $col3 = NULL;
        $col4 = NULL;
        $col5 = NULL;
        $col6 = NULL;
        echo "<b>TABLE project</b>";
        echo "<table id='table'>";
        echo "<tr>";
        echo "<th>id</th>";
        echo "<th>title</th>";
        echo "<th>description</th>";
        echo "<th>category</th>";
        echo "<th>start_date</th>";
        echo "<th>duration</th>";
        echo "</tr>";
        while ($row = pg_fetch_assoc($result)) {
            $text1 = '';
            $text2 = '';
            $text3 = '';
            $text4 = '';
            $text5 = '';
            $text6 = '';
            if ($row['id'] != $col1 ||
                $row['title'] != $col2 ||
                $row['description'] != $col3 ||
                $row['category'] != $col4 ||
                $row['start_date'] != $col5 ||
                $row['duration'] != $col6) {
                $col1 = $row['id'];
                $col2 = $row['title'];
                $col3 = $row['description'];
                $col4 = $row['category'];
                $col5 = $row['start_date'];
                $col6 = $row['duration'];
                $text1 = $col1;
                $text2 = $col2;
                $text3 = $col3;
                $text4 = $col4;
                $text5 = $col5;
                $text6 = $col6;
            }
            
            echo "<tr>";
            echo "<td align='left' width='100'>" . $text1 . "</td>";
            echo "<td align='left' width='350'>" . $text2 . "</td>";
            echo "<td align='left' width='350'>" . $text3 . "</td>";
            echo "<td align='left' width='200'>" . $text4 . "</td>";
            echo "<td align='left' width='350'>" . $text5 . "</td>";
            echo "<td align='left' width='350'>" . $text6 . "</td>";
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
        $col5 = NULL;
        echo "<b>TABLE advertise</b>";
        echo "<table id='table'>";
        echo "<tr>";
        echo "<th>entrepreneur</th>";
        echo "<th>proj_id</th>";
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
            
            if ($row['entrepreneur'] != $col1 ||
                $row['proj_id'] != $col2 ||
                $row['amt_needed'] != $col3 ||
                $row['amt_raised'] != $col4 ||
                $row['status'] != $col5) {
                $col1 = $row['entrepreneur'];
                $col2 = $row['proj_id'];
                $col3 = $row['amt_needed'];
                $col4 = $row['amt_raised'];
                $col5 = $row['status'];
                $text1 = $col1;
                $text2 = $col2;
                $text3 = $col3;
                $text4 = $col4;
                $text5 = $col5;
            }
            echo "<tr>";
            echo "<td align='left' width='200'>" . $text1 . "</td>";
            echo "<td align='left' width='350'>" . $text2 . "</td>";
            echo "<td align='left' width='350'>" . $text3 . "</td>";
            echo "<td align='left' width='350'>" . $text4 . "</td>";
            echo "<td align='left' width='50'>" . $text5 . "</td>";
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
            echo "<td align='left' width='100'>" . $text2 . "</td>";
            echo "<td align='left' width='350'>" . $text3 . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
?>
