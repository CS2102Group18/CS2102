<?php
echo "Starting Session";
session_start();
include 'db.php';

$result = pg_query($db, "UPDATE advertised_project SET entrepreneur = '$_POST[entrepreneur]', title = '$_POST[title]', description = '$_POST[description]', category = '$_POST[category]', duration = $_POST[duration], amt_needed = $_POST[amountneeded] WHERE id = '$_POST[projectid]'");

header("location:../public/admin.php");
die();
?>
