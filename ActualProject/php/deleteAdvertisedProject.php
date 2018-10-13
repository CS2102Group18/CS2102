<?php
    function deleteProject($db, $id){
        $result = pg_query($db, "DELETE FROM advertised_project WHERE id= '$id'");
        return $result; 
	}
?>