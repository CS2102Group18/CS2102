<?php
    // Create investment
    function createInvestment($investor, $proj_id, $amount) {
		return pg_query($db, "INSERT into invest(investor, proj_id, amount) VALUES( '$investor', '$proj_id', '$amount'");
	}

    // Update investment of the given project with specified amount by an investor
    function updateInvestmentAmount($db, $investor, $project, $amount) {
        return pg_query($db, "UPDATE invest SET amount='$amount' WHERE investor='$investor' AND proj_id='$project'");
	}
    
    // Get all investments made by the specified member
    function getAllInvestmentsOfInvestor($db, $investor) {
        return pg_query($db, "SELECT * FROM advertised_project p, invest i WHERE i.proj_id=p.id AND i.investor='$investor' ORDER BY p.title;");
    }
    
    // Delete investment
    function deleteInvestment($db, $investor, $proj_id){
        return pg_query($db, "DELETE FROM invest WHERE investor='$investor' AND proj_id='$proj_id'");
	}
?>