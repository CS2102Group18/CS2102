<?php
    include "member.php";
    include "project.php";
    include "advertised_project.php";

    // Generate a statistical report
    function generateReport($db) {
        $filename = "report" . ".xls";
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");

        echo "Top 3 investors who invested the most amount \r\n";
        $highestInvestors = getTopThreeInvestors($db);
        $flag = false;
        while(false !== ($row = pg_fetch_assoc($highestInvestors))) {
          if(!$flag) {
            // display field/column names as first row
            echo implode("\t", array_keys($row)) . "\r\n";
            $flag = true;
          }
          array_walk($row, __NAMESPACE__ . '\cleanData');
          echo implode("\t", array_values($row)) . "\r\n";
        }

        echo "\r\n\r\n";

        echo "Top 3 entrepreneurs who advertised the most number of projects \r\n";
        $highestEntrepreneurs = getTopThreeEntrepreneurs($db);
        $flag = false;
        while(false !== ($row = pg_fetch_assoc($highestEntrepreneurs))) {
          if(!$flag) {
            echo implode("\t", array_keys($row)) . "\r\n";
            $flag = true;
          }
          array_walk($row, __NAMESPACE__ . '\cleanData');
          echo implode("\t", array_values($row)) . "\r\n";
        }

        echo "\r\n\r\n";

        exit;
    }

    // Get top three investors who invested the most amount of money
    // Allow ties
    function getTopThreeInvestors($db) {
        return pg_query($db, "WITH rankedtable AS (
                                SELECT investor, SUM(amount) AS total_amount, rank() OVER (ORDER BY SUM(amount) DESC) FROM invest
                                GROUP BY investor
                              )
                              SELECT investor, total_amount
                              FROM rankedtable WHERE rank < 4
                              ORDER BY rank, investor;");
    }

    // Get top three entrepreneur who advertised the most number of projects
    // Allow ties
    function getTopThreeEntrepreneurs($db) {
        return pg_query($db, "WITH rankedTable AS (
                                SELECT entrepreneur, COUNT(*) AS total_projects, rank() OVER (ORDER BY COUNT(*) DESC)
                                FROM advertised_project
                                GROUP BY entrepreneur
                              )
                              SELECT entrepreneur, total_projects
                              FROM rankedTable WHERE rank < 4
                              ORDER BY RANK, entrepreneur;");
    }


    function cleanData(&$str) {
        $str = preg_replace("/\t/", "\\t", $str);
        $str = preg_replace("/\r?\n/", "\\n", $str);
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
   }
?>
