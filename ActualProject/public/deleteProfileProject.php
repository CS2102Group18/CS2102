<?php
  echo "Starting Session";
  session_start();
  include 'db.php';
  include '../php/deleteAdvertisedProject.php';

  $id = $_POST['projId'];
  deleteProject($db, $id);

  header("location:profile.php");
?>
