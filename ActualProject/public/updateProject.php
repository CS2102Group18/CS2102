<?php
  echo "Starting Session";
  session_start();
  include 'db.php';
  include '../php/updateProject.php';
  include '../php/updateAdvertise.php';

  $projectId = $_POST['formId'];
  $description = $_POST['descriptionInput'];
  $amtNeeded = $_POST['targetAmount'];

  echo "<script>console.log('inside update.php')</script>";

  updateProjectDescription($db, $projectId, $description);
  updateAmountNeeded($db, $projectId, $amtNeeded);

  header("location:profile.php");
?>
