<?php
echo "Starting Session";
session_start();
include 'db.php';

//echo "$_POST[inputEntrepreneur] $_POST[inputTitle] $_POST[inputDescription] $_POST[inputCategory] $_POST[inputDuration] $_POST[inputAmountNeeded]";

//echo "$_POST[inputUsername] $_POST[inputPassword] $_POST[inputEmail] $_POST[inputBio]";
//requires session input from linked php page
$result = pg_query($db, "INSERT INTO advertised_project (entrepreneur, title, description, category, duration, amt_needed) VALUES ('$_POST[inputEntrepreneur]','$_POST[inputTitle]', '$_POST[inputDescription]', '$_POST[inputCategory]', $_POST[inputDuration], $_POST[inputAmountNeeded])");
	
header("location:../public/admin.php");
?>
