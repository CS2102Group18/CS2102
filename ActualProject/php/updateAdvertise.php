<?php
    // Update amount needed for a project
    function updateAmountNeeded($db, $project, $amount) {
        $result = pg_query($db, "UPDATE advertise SET amt_needed='$amount' WHERE proj_id='$project'");
        return $result; 
	}
?>