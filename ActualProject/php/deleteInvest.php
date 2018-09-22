<?php
    function deleteInvest($db, $investor, $proj_id){
        $result = pg_query($db, "DELETE FROM invest WHERE id='$investor' AND proj='$proj_id'");
        return $result; 
	}
?>