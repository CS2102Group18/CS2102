<?php
    // Create a new investment
    function createInvestment($db, $investor, $proj_id, $amount) {
		return pg_query($db, "INSERT INTO invest(investor, proj_id, amount) VALUES('$investor', '$proj_id', '$amount')");
	}
    
    // Create new investment if does not exist, else update
    function investInProject($db, $investor, $proj_id, $amount) {
        $hasInvestedBefore = hasInvestedInProject($db, $investor, $proj_id);

        if ($hasInvestedBefore) {
            $result = getAmtInvestedInProjectByInvestor($db, $investor, $proj_id);
            $prevAmount = pg_fetch_result($result, 0, 0);
            updateInvestmentAmount($db, $investor, $proj_id, $amount+$prevAmount);
        } else {
            createInvestment($db, $investor, $proj_id, $amount);
        }
    }

    // Update investment of the given project with specified amount by an investor
    function updateInvestmentAmount($db, $investor, $proj_id, $amount) {
        return pg_query($db, "UPDATE invest SET amount='$amount' WHERE investor='$investor' AND proj_id='$proj_id'");
	}
    
    // Get all investments made by the specified member
    function getAllInvestmentsOfInvestor($db, $investor) {
        return pg_query($db, "SELECT * FROM advertised_project p, invest i WHERE i.proj_id=p.id AND i.investor='$investor' ORDER BY p.title;");
    }
    
    // Get the amount invested in the specified project by the specified investor
    function getAmtInvestedInProjectByInvestor($db, $investor, $proj_id) {
        return pg_query($db, "SELECT amount FROM invest WHERE investor='$investor' AND proj_id='$proj_id'");
    }
    
    // Returns true if the specified investor had invested in the specified project previously
    function hasInvestedInProject($db, $investor, $proj_id) {
        $investment = pg_query($db, "SELECT * FROM invest WHERE investor='$investor' AND proj_id='$proj_id'");
        $numRows = pg_num_rows($investment);
        echo "<script>console.log('$numRows');</script>";
        return ($numRows > 0) ? TRUE : FALSE;
    }

    // Delete investment
    function deleteInvestment($db, $investor, $proj_id){
        return pg_query($db, "DELETE FROM invest WHERE investor='$investor' AND proj_id='$proj_id'");
	}
?>