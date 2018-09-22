<?php
    function deleteMember($db, $username){
        $result = pg_query($db, "DELETE FROM member WHERE username= '$username'");
        return $result; 
	}
?>