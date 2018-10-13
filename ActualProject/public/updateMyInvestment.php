<?php
  echo "Starting Session";
  session_start();
  include '../php/db.php';
  include '../php/updateInvest.php';

  $UNAME = $_SESSION['username'];	//retrieve USERNAME

  $projectId = $_POST['projectId'];
  $amtNeeded = $_POST['amtInvested'];

  updateInvestmentAmount($db, $UNAME, $projectId, $amtNeeded);

  header("location:profile.php");
?>
