<?php
    function deleteProject($db, $id){
        $result = pg_query($db, "DELETE FROM project WHERE id= '$id'");
        return $result; 
	}
?>