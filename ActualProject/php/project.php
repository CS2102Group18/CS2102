<?php
    // Create project
    function createProject($db, $entrepreneur, $title, $description, $category, $amtNeeded) {
        return pg_query($db, "INSERT INTO advertised_project(entrepreneur, title, description, category, amt_needed) VALUES('$entrepreneur','$title', '$description', '$category','$amtNeeded')");
    }
    
    // Update title of a given project
    function updateProjectTitle($db, $id, $title) {
        return pg_query($db, "UPDATE advertised_project SET title='$title' WHERE id='$id'");
	}
    
    // Update description of a given project
    function updateProjectDescription($db, $id, $description) {
        return pg_query($db, "UPDATE advertised_project SET description='$description' WHERE id='$id'"); 
	}
    
    // Update category of a given project
    function updateProjectCategory($db, $id, $category) {
        return pg_query($db, "UPDATE advertised_project SET category='$category' WHERE id='$id'");
	}
    
    // Update start date of a given project
    function updateProjectStartDate($db, $id, $start_date) {
        return pg_query($db, "UPDATE advertised_project SET start_date='$start_date' WHERE id='$id'");
	}
    
    // Update duration of a given project
    function updateProjectDuration($db, $id, $duration) {
        return pg_query($db, "UPDATE advertised_project SET duration='$duration' WHERE id='$id'");
	}
    
    // Update amount needed of the project
    function updateAmountNeeded($db, $id, $amount) {
        return pg_query($db, "UPDATE advertised_project SET amt_needed='$amount' WHERE id='$id'");
	}
    
    // Get all the projects that are advertised by the specified member
    function getAllAdvertisedProjectsByEntrepreneur($db, $entrepreneur) {
        return pg_query($db, "SELECT * FROM advertised_project p WHERE p.entrepreneur = '$entrepreneur' ORDER BY p.title;");
    }

    // Delete project
    function deleteProject($db, $id){
        return pg_query($db, "DELETE FROM advertised_project WHERE id= '$id'");
	}
?>
