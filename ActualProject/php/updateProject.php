<?php
    // Update title of a given project
    function updateProjectTitle($db, $id, $title) {
        $result = pg_query($db, "UPDATE project SET title='$title' WHERE id='$id'");
        return $result; 
	}
    
    // Update description of a given project
    function updateProjectDescription($db, $id, $description) {
        $result = pg_query($db, "UPDATE project SET description='$description' WHERE id='$id'");
        return $result; 
	}
    
    // Update category of a given project
    function updateProjectCategory($db, $id, $category) {
        $result = pg_query($db, "UPDATE project SET category='$category' WHERE id='$id'");
        return $result; 
	}
    
    // Update start date of a given project
    function updateProjectStartDate($db, $id, $start_date) {
        $result = pg_query($db, "UPDATE project SET start_date='$start_date' WHERE id='$id'");
        return $result; 
	}
    
    // Update duration of a given project
    function updateProjectDuration($db, $id, $duration) {
        $result = pg_query($db, "UPDATE project SET duration='$duration' WHERE id='$id'");
        return $result; 
	}
?>