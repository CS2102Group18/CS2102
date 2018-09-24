<?php
    function createMember($db, $username, $password) {
        $result = pg_query($db, "INSERT INTO member(username, password) VALUES ('$username', '$password')");
        return $result;
  }
?>
