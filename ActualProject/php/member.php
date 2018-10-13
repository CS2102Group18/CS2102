<?php
    // Create Member
    function createMember($db, $username, $password) {
        $result = pg_query($db, "INSERT INTO member(username, password) VALUES ('$username', '$password')");
        return $result;
    }
    
    // Update password
    function updatePassword($db, $username, $password) {
        $result = pg_query($db, "UPDATE member SET password='$password' WHERE username='$username'");
        return $result; 
	}
    
    // Update email
    function updateEmail($db, $username, $email) {
        $result = pg_query($db, "UPDATE member SET email='$email' WHERE username='$username'");
        return $result; 
	}
    
    // Update biography
    function updateBiography($db, $username, $biography) {
        $result = pg_query($db, "UPDATE member SET biography='$biography' WHERE username='$username'");
        return $result; 
	}
    
    // Change admin status
    function updatePrivilege($db, $username, $is_admin) {
        $result = pg_query($db, "UPDATE member SET is_admin='$is_admin' WHERE username='$username'");
        return $result; 
	}
  
    // Delete Member
    function deleteMember($db, $username){
        $result = pg_query($db, "DELETE FROM member WHERE username= '$username'");
        return $result; 
	}
?>