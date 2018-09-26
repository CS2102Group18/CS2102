<?php
  echo "Starting Session";
  session_start();
  include 'db.php';
  include '../php/deleteProject.php';

  $id = $_POST['projId'];
  deleteProject($db, $id);

  header("location:profile.php");
?>
