<?php
  echo "Starting Session";
  session_start();
  include 'db.php';
  include '../php/updateProject.php';
  include '../php/updateAdvertise.php';

  $projectId = $_POST['projectId'];
  $description = $_POST['descriptionInput'];
  $amtNeeded = $_POST['targetAmount'];

  updateProjectDescription($db, $projectId, $description);
  updateAmountNeeded($db, $projectId, $amtNeeded);

  header("location:profile.php");
?>
