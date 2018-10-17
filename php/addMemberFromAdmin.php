<?php
echo "Starting Session";
session_start();
include 'db.php';
include 'member.php';

//echo "$_POST[inputUsername] $_POST[inputPassword] $_POST[inputEmail] $_POST[inputBio]";
//requires session input from linked php page
$result = pg_query($db, "INSERT INTO member (username, password, email, biography) VALUES ('$_POST[inputUsername]',$_POST[inputPassword], '$_POST[inputEmail]', '$_POST[inputBio]')");

header("location:../public/admin.php");
?>
