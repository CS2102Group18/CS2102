<?php
    // Search project by title, description, entrepreneur filter by category
    function searchProject($db, $category, $text) {
       echo "<script>console.log('Category:' + '$category');</script>";
       echo "<script>console.log('Text:' + '$text');</script>";
       echo "<script>console.log('afsdfsdf');</script>";

        $text = trim($text);
        $query = "";
        if ($text=="" && $category=="") {
            $query = "SELECT * FROM advertised_project";
        }
        elseif ($text!="" && $category=="") {
            $query = "SELECT * FROM advertised_project WHERE title LIKE '%" . $text . "%' OR description LIKE '%" . $text . "%' OR entrepreneur LIKE '%" . $text . "%'";
        }
        else {
            $query = "SELECT * FROM advertised_project WHERE category='" . $category . "' AND (title LIKE '%" . $text . "%' OR description LIKE '%" . $text . "%' OR entrepreneur LIKE '%" . $text . "%')";
        }

        return pg_query($db, $query);
    }
?>
