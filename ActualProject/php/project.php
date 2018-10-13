<?php
    // Create project
    function createProject($db, $title, $description, $category) {
        $projectResult = pg_query($db, "INSERT INTO project(title, description, category) VALUES('$_POST[title]', '$_POST[description]', '$_POST[category]')");
    }
    
    // Update title of a given project
    function updateProjectTitle($db, $id, $title) {
        $result = pg_query($db, "UPDATE advertised_project SET title='$title' WHERE id='$id'");
        return $result; 
	}
    
    // Update description of a given project
    function updateProjectDescription($db, $id, $description) {
        $result = pg_query($db, "UPDATE advertised_project SET description='$description' WHERE id='$id'");
        return $result; 
	}
    
    // Update category of a given project
    function updateProjectCategory($db, $id, $category) {
        $result = pg_query($db, "UPDATE advertised_project SET category='$category' WHERE id='$id'");
        return $result; 
	}
    
    // Update start date of a given project
    function updateProjectStartDate($db, $id, $start_date) {
        $result = pg_query($db, "UPDATE advertised_project SET start_date='$start_date' WHERE id='$id'");
        return $result; 
	}
    
    // Update duration of a given project
    function updateProjectDuration($db, $id, $duration) {
        $result = pg_query($db, "UPDATE advertised_project SET duration='$duration' WHERE id='$id'");
        return $result; 
	}
    
    // Update amount needed of the project
    function updateAmountNeeded($db, $id, $amount) {
        $result = pg_query($db, "UPDATE advertised_project SET amt_needed='$amount' WHERE id='$id'");
        return $result; 
	}

    // Delete project
    function deleteProject($db, $id){
        $result = pg_query($db, "DELETE FROM advertised_project WHERE id= '$id'");
        return $result; 
	}
?>
