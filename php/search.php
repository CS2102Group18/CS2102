<?php
    // Search project by title, description, entrepreneur filter by category
    function searchProject($db, $category, $text) {
        $query = "SELECT * FROM advertised_project WHERE category='" . $category . "' AND (title LIKE '%" . $text . "%' OR description LIKE '%" . $text . "%' OR entrepreneur LIKE '%" . $text . "%')";
        return pg_query($db, $query);
    }
?>
