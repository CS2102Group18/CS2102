<?php
    function styleTable() {
        echo "<style>td{text-align: center;}</style>";
    }

    function displayTableMember($db) {
        $result = pg_query($db, "SELECT * FROM member ORDER BY username");
        $col1 = NULL;
        $col2 = NULL;
        $col3 = NULL;
        $col4 = NULL;
        $col5 = NULL;
        echo "<b>TABLE member</b>";
        echo "<table id='table'>";
        echo "<tr>";
        echo "<th>username</th>";
        echo "<th>password</th>";
        echo "<th>email</th>";
        echo "<th>biography</th>";
        echo "<th>is_admin</th>";
        echo "</tr>";
        while ($row = pg_fetch_assoc($result)) {
            $text1 = '';
            $text2 = '';
            $text3 = '';
            $text4 = '';
            $text5 = '';
            if ($row['username'] != $col1 ||
                $row['password'] != $col2 ||
                $row['email'] != $col3 ||
                $row['biography'] != $col4 ||
                $row['is_admin'] != $col5) {
                $col1 = $row['username'];
                $col2 = $row['password'];
                $col3 = $row['email'];
                $col4 = $row['biography'];
                $col5 = $row['is_admin'];
                $text1 = $col1;
                $text2 = $col2;
                $text3 = $col3;
                $text4 = $col4;
                $text5 = $col5;
            }

            echo "<tr>";
            echo "<td align='center' width='200'>" . $text1 . "</td>";
            echo "<td align='center' width='200'>" . $text2 . "</td>";
            echo "<td align='center' width='200'>" . $text3 . "</td>";
            echo "<td align='center' width='500'>" . $text4 . "</td>";
            echo "<td align='center' width='50'>" . $text5 . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    function displayTableProject($db) {
        $result = pg_query($db, "SELECT * FROM advertised_project ORDER BY id");
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

    function displayTableInvest($db) {
        $result = pg_query($db, "SELECT * FROM invest ORDER BY investor");
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
            echo "<td align='center' width='200'>" . $text1 . "</td>";
            echo "<td align='center' width='100'>" . $text2 . "</td>";
            echo "<td align='center' width='350'>" . $text3 . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
?>
