<?php
echo "Starting Session";
session_start();
include 'db.php';
include 'project.php';

$id = $_POST[deletedProject];
$result = deleteProject($db, $id);
$row = pg_num_rows($result);

header("location:../public/admin.php");
die();
?>
