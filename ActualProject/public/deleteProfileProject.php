<?php
  echo "Starting Session";
  session_start();
  include 'db.php';

  $id = $_POST['projId'];
  $result = pg_query($db, "DELETE FROM project WHERE id='$id'");

  header("location:profile.php");
?>
