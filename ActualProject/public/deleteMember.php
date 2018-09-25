<?php
echo "Starting Session";
session_start();
include 'db.php';

$user = $_POST['deletedUser'];
$result = pg_query($db, "DELETE FROM member where username = '$user'");
$row = pg_num_rows($result);
if($row > 0) {
	echo "Delete Success";
}
else{
	echo "Delete Failed";
}
header("location:admin.php");
?>
