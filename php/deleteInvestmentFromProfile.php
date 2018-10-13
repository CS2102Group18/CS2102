<?php
  echo "Starting Session";
  session_start();
  include 'db.php';
  include 'investment.php';

  $UNAME = $_SESSION['username'];	//retrieve USERNAME

  $id = $_POST['projId'];
  deleteInvestment($db, $UNAME, $id);

  header("location:../public/profile.php");
?>
