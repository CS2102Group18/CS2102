<?php
  echo "Starting Session";
  session_start();
  include 'db.php';
  include '../php/deleteProject.php';

  $id = $_POST['projId'];
  // $result = pg_query($db, "DELETE FROM project WHERE id='$id'");
  deleteProject($db, $id);

  header("location:profile.php");
?>
