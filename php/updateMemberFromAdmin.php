<?php
echo "Starting Session";
session_start();
include 'db.php';
include 'member.php';

$user = $_POST['currentUser'];
$newUserName = $_POST[''];
$result = updateMember($db, $user, $);
$row = pg_num_rows($result);
if($row > 0) {
	echo "Delete Success";
}
else{
	echo "Delete Failed";
}
header("location:../public/admin.php");
?>
