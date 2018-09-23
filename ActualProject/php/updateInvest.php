<?php
    // Update investment of the given project with specified amount by an investor
    function updateInvestmentAmount($db, $investor, $project, $amount) {
        $result = pg_query($db, "UPDATE invest SET amount='$amount' WHERE investor='$investor' AND proj_id='$project'");
        return $result; 
	}
?>