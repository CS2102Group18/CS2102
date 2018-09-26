<?php
  echo "Starting Session";
  session_start();
  include 'db.php';
  include '../php/deleteInvest.php';

  $UNAME = $_SESSION['username'];	//retrieve USERNAME

  $id = $_POST['projId'];
  // $result = pg_query($db, "DELETE FROM project WHERE id='$id'");
  deleteInvest($db, $UNAME, $id);

  header("location:profile.php");
?>
