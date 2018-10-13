<?php
  echo "Starting Session";
  session_start();
  include 'db.php';
  include 'project.php';

  $id = $_POST['projId'];
  deleteProject($db, $id);

  header("location:../public/profile.php");
?>
