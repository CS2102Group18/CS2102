<?php
echo "Starting Session";
session_start();
include 'db.php';
include 'member.php';

//requires session input from linked php page
$result = pg_query($db, "UPDATE member SET username = '$_POST[newUser]', password = $_POST[newPassword], email = '$_POST[newEmail]', biography = '$_POST[newBiography]' WHERE username = '$_POST[currentUser]'");

$row = pg_num_rows($result);
if($row > 0) {
	echo "Update Success";
}
else{
	echo "Update Failed";
}
header("location:../public/admin.php");
?>
