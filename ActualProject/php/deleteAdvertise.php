<?php
    function deleteAdvertisement($db, $project){
        $result = pg_query($db, "DELETE FROM advertise WHERE proj_id= '$project'");
        return $result; 
	}
?>