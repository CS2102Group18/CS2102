<?php
include '../public/php/updateMember.php';
include 'db.php';
session_start();
if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == true) {
	//	echo "You're logged into the Profile's area " . $_SESSION['username'] . "!";
} else {
	header("location:login.php");
}
$UNAME = $_SESSION['username'];	//retrieve USERNAME

$resultBiography = pg_query($db, "SELECT biography FROM member WHERE username = '$UNAME'");
$rowBiography = pg_fetch_row($resultBiography);
$resultEmail = pg_query($db, "SELECT email FROM member WHERE username = '$UNAME'");
$rowEmail = pg_fetch_row($resultEmail);

if(isset($_POST['update'])) {

	$email = $_POST[emailInput];
	$biography = $_POST[biographyInput];
	$password = $_POST[password];
	$rePassword = $_POST[password];
	$isUpdateEmail = false;
	$isUpdatePassword = false;
	$matchPassword = true;
	$isUpdateBiography = false;

	echo "<script>console.log( 'new Biography Object: " . $biography . "' );</script>";
	echo "<script>console.log( 'new Email Object: " . $email . "' );</script>";
	echo "<script>console.log( 'userName Object: " . $UNAME . "' );</script>";

	//If password fields are not empty
	if(!empty($password) && !empty($rePassword)) {
		if($password == $rePassword) {
			$mismatchPassword = true;
			$isUpdatePassword = true;
		} else {
			echo"<script>console.log( 'There is mismatch in password' );</script>";
			$matchPassword = false;
		}
	}
	if(!empty($biography)) {
		$isUpdateBiography = true;
	}
	if(!empty($email)) {
		$isUpdateEmail = true;
	}

	//If no password reset is required
	if($matchPassword) {
		if($isUpdatePassword) {
			$sqlUpdatePassword = pg_query($db, updatePassword($db, $UNAME, $password));
			if(!$sqlUpdatePassword) {
					echo "<script>alert('Update Password');</script>";
			}
		}
		if($isUpdateEmail) {
			$sqlUpdateEmail = pg_query($db, updateEmail($db, $UNAME, $email));
			if(!$sqlUpdateEmail) {
					echo "<script>alert('Update Email');</script>";
			}
		}
		if($isUpdateBiography) {
			$sqlUpdateBiography = pg_query($db, updateBiography($db, $UNAME, $biography));
			if(!$sqlUpdateBiography) {
					echo "<script>alert('Update Biography');</script>";
			}
		}
	}
	else {
		  echo "<script>alert('Please check your fields again');</script>";
	}
}
?>
<html>
<head>
	<title>My Profile Page</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>
	body {
		font-family: Arial, Helvetica, sans-serif;
		background-color: GhostWhite;
	}
	.myInvestmentTable {
		width: 95%;
	}
</style>
</head>
<body>

	<div class="container">
		<h2>Profile Page Test</h2>
		<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#home">My Profile</a></li>
			<li><a data-toggle="tab" href="#menu1">My Project & Investments test</a></li>
		</ul>
		<div class="tab-content">
			<div id="home" class="tab-pane fade in active">
				<form action="profile.php", method = "POST">
					<div class="form-group row">
						<label for="username" class="col-4 col-form-label">User Name : <?php echo "$UNAME";?> </label>
					</div>
					<div class="form-group row">
						<label for="email" class="col-4 col-form-label">Current Email : <?php echo "$rowEmail[0]"; ?></label>
						<div class="col-8">
							<input id="email" name="emailInput" placeholder="New Email" class="form-control here" type="text">
						</div>
					</div>
					<div class="form-group row">
						<label for="publicinfo" class="col-4 col-form-label">Biography</label>
						<div class="col-8">
							<textarea id="publicinfo" name="biographyInput" cols="40" rows="4" class="form-control"> <?php echo "$rowBiography[0]"; ?> </textarea>
						</div>
					</div>
					<div class="form-group row">
						<label for="newpass" class="col-4 col-form-label">Reset Password</label>
						<div class="col-8">
							<input type ="password" id="newpass" name="newpass" placeholder="New Password" class="form-control here" type="text">
							<input type ="password" id="newpassRepeatId" name="newpassRepeat" placeholder="Re-Enter New Password" class="form-control here" type="text">
						</div>
					</div>
					<div class="form-group row">
						<div class="offset-4 col-8">
							<button name="update" type="submit" class="btn btn-primary">Update My Profile</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
