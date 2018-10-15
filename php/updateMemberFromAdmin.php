<?php
echo "Starting Session";
session_start();
include 'db.php';
include 'member.php';

//requires session input from linked php page
$userToUpdate = $_SESSION['userToUpdate'];

$newUserName = $_POST['newUsername'];
$newPassword = $_POST['newPassword'];
$newEmail = $_POST['newEmail'];
$newBiography = $_POST['newBiography'];

$result = updateMember($db, $userToUpdate, $newUserName, $newPassword, $newEmail, $newBiography);

$row = pg_num_rows($result);
if($row > 0) {
	echo "Update Success";
}
else{
	echo "Update Failed";
}
header("location:../public/admin.php");
?>
