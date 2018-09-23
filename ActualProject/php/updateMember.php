<?php
    // Update password
    function updatePassword($db, $username, $password) {
        $result = pg_query($db, "UPDATE member SET password='$password' WHERE username='$username'");
        return $result; 
	}
    
    // Change admin status
    function updatePrivilege($db, $username, $is_admin) {
        $result = pg_query($db, "UPDATE member SET is_admin='$is_admin' WHERE username='$username'");
        return $result; 
	}
?>