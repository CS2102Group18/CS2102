<?php
  echo "Starting Session";
  session_start();
  include '../php/db.php';
  include '../php/updateAdvertisedProject.php';

  $projectId = $_POST['projectId'];
  $description = $_POST['descriptionInput'];
  $category = $_POST['category'];
  $amtNeeded = $_POST['targetAmount'];
  $startDate = $_POST['startDate'];
  $duration = $_POST['duration'];

  updateProjectDescription($db, $projectId, $description);
  updateProjectCategory($db, $projectId, $category);
  updateAmountNeeded($db, $projectId, $amtNeeded);
  updateProjectStartDate($db, $projectId, $startDate);
  updateProjectDuration($db, $projectId, $duration);

  header("location:profile.php");
?>
