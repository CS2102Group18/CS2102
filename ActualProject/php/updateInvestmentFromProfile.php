<?php
  echo "Starting Session";
  session_start();
  include 'db.php';
  include 'investment.php';

  $UNAME = $_SESSION['username'];	//retrieve USERNAME

  $projectId = $_POST['projectId'];
  $amtNeeded = $_POST['amtInvested'];

  updateInvestmentAmount($db, $UNAME, $projectId, $amtNeeded);

  header("location:../public/profile.php");
?>
