<?php
    function deleteInvest($db, $investor, $proj_id){
        $result = pg_query($db, "DELETE FROM invest WHERE investor='$investor' AND proj_id='$proj_id'");
        return $result; 
	}
?>