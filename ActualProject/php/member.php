<?php
    // Create Member
    function createMember($db, $username, $password) {
        return pg_query($db, "INSERT INTO member(username, password) VALUES ('$username', '$password')");
    }
    
    // Update password
    function updatePassword($db, $username, $password) {
        return pg_query($db, "UPDATE member SET password='$password' WHERE username='$username'");
	}
    
    // Update email
    function updateEmail($db, $username, $email) {
        return pg_query($db, "UPDATE member SET email='$email' WHERE username='$username'");
	}
    
    // Update biography
    function updateBiography($db, $username, $biography) {
        return pg_query($db, "UPDATE member SET biography='$biography' WHERE username='$username'");
	}
    
    // Update admin status
    function updatePrivilege($db, $username, $is_admin) {
        return pg_query($db, "UPDATE member SET is_admin='$is_admin' WHERE username='$username'");
	}
    
    // Get email of a specified member
    function getEmailOfMember($db, $username) {
        return pg_query($db, "SELECT email FROM member WHERE username = '$username'");
    }
    
    // Get biography of a specified member
    function getBiographyOfMember($db, $username) {
        return pg_query($db, "SELECT biography FROM member WHERE username = '$username'");
    }
    
    // Return true if specified member is an admin
    function isMemberAdmin($db, $username) {
        $result = pg_query($db, "SELECT is_admin FROM member WHERE username = '$username'");
        $answer = pg_fetch_result($result, 0, 0);
        return ($answer == 1) ? TRUE : FALSE;
    }
  
    // Delete Member
    function deleteMember($db, $username){
        return pg_query($db, "DELETE FROM member WHERE username= '$username'");
	}
?>