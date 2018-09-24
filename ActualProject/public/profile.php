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
		<h2>Profile Page</h2>
		<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#home">My Profile</a></li>
			<li><a data-toggle="tab" href="#menu1">My Project & Investments</a></li>
		</ul>

		<div class="tab-content">
			<div id="home" class="tab-pane fade in active">
				<form>
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
			<div id="menu1" class="tab-pane fade">
				<h3>My Projects</h3>
				<form>
					<div class="form-group row">
						<div class="row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table id="myProjectTable" class="table table-bordred table-striped">
										<thead>
											<th>Project Name</th>
											<th>Project Id</th>
											<th>Amount Raised</th>
											<th>Target Amount</th>
											<th>Status</th>
											<th>Edit</th>
											<th>Delete</th>
											<tbody>
											</thead>
										</div>
										<tr>
											<td>Dummy Name</td>
											<td>Dummy Id</td>
											<td>Dummy Amount Raised</td>
											<td>Target Amount</td>
											<td>Dummy Status</td>
											<td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
											<td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</form>
				<h3>My Investments</h3>
				<form>
					<div class="form-group row">
						<div class="row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table id="myInvestmentTable" class="table table-bordred table-striped">
										<thead>
											<th>Project Name</th>
											<th>Project Id</th>
											<th>Amount Invested</th>
											<th>Target Amount</th>
											<th>Status</th>
											<th>Withdraw</th>
											<tbody>
											</thead>
										</div>
										<tr>
											<td>Dummy Name</td>
											<td>Dummy Id</td>
											<td>Dummy Amount Invested</td>
											<td>Target Amount</td>
											<td>Dummy Status</td>
											<td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
<?php
if(isset(($_POST['update']))) {

	$email = $_POST[emailInput];
	$isUpdateEmail = false;
	$password = $_POST[newpass];
	$rePassword = $_POST[newPassRepeat];
	$isUpdatePassword = false;
	$mismatchPassword = false;

	$biography = $_POST[biographyInput];
	$isUpdateBiography = false;

	echo "<script>console.log('TEST');</script>";
	echo "<script>alert('TEST');</script>";
	//Following backend queries are needed for update of Profile
	//Check for Password first
	if(empty($password)) {
		echo "<script>console.log('Password empty');</script>";
		echo "<script>alert('Password empty');</script>";
	}
	if(!empty($password) && !empty($rePassword)) {
		if($password == $rePassword) {
			$isUpdatePassword = true;
			echo "<script>alert('Password Correct or un needed');</script>";
		} else {
			echo "<script>console.log('Password mismatch');</script>";
			echo "<script>alert('Password mismatch');</script>";
			$mismatchPassword = true;
		}
	}
	if(!empty($email)) {
		$isUpdateEmail = true;
	}
	if(!empty($biography)) {
		$isUpdateBiography = true;
	}
	if(!$mismatchPassword) {
		// echo "Entered no mismatch password or no password reset required";
		if($isUpdatePassword) {
			$sqlUpdatePassword = pg_query($db, updatePassword($db, $UNAME, $password));
			// echo "<script>console.log('Update Success Password');</script>";
		}
		if($isUpdateEmail) {
			$sqlUpdateEmail = pg_query($db, updateEmail($db, $UNAME, $email));
			// echo "<script>console.log('Update Success Email');</script>";
		}
		if($isUpdateBiography) {
			$sqlUpdateBiography = pg_query($db, updateBiography($db, $UNAME, $biography));
			// echo "<script>console.log('Update Success Biography');</script>";
		}
	}
}
?>
</html>
