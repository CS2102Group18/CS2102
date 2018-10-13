<?php
    // Create investment
    function createInvestment($investor, $proj_id, $amount) {
		$result = pg_query($db, "INSERT into invest(investor, proj_id, amount) VALUES( '$investor', '$proj_id', '$amount'");
        return $result;
	}

    // Update investment of the given project with specified amount by an investor
    function updateInvestmentAmount($db, $investor, $project, $amount) {
        $result = pg_query($db, "UPDATE invest SET amount='$amount' WHERE investor='$investor' AND proj_id='$project'");
        return $result; 
	}
    
    // Delete investment
    function deleteInvestment($db, $investor, $proj_id){
        $result = pg_query($db, "DELETE FROM invest WHERE investor='$investor' AND proj_id='$proj_id'");
        return $result; 
	}
?>