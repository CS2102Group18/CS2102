<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<?php
    include '../php/db.php';
    include '../php/member.php';
    include '../php/project.php';
    include '../php/investment.php';

	session_start();
	if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == true) {
		//	echo "You're logged into the Profile's area " . $_SESSION['username'] . "!";
	} else {
		header("location:login.php");
	}
	$UNAME = $_SESSION['username'];	//retrieve USERNAME

	$resultBiography = getBiographyOfMember($db, $UNAME);
	$rowBiography = pg_fetch_row($resultBiography);
	$resultEmail = getEmailOfMember($db, $UNAME);
	$rowEmail = pg_fetch_row($resultEmail);

	if(isset($_POST['update'])) {

		$email = $_POST[emailInput];
		$biography = $_POST[biographyInput];
		$password = $_POST[newpass];
		$rePassword = $_POST[newpassRepeat];
		$isUpdateEmail = false;
		$isUpdatePassword = false;
		$matchPassword = true;
		$isUpdateBiography = false;

		echo "<script>console.log( 'new Biography Object: " . $biography . "' );</script>";
		echo "<script>console.log( 'new Email Object: " . $email . "' );</script>";
		echo "<script>console.log( 'userName Object: " . $UNAME . "' );</script>";

		//If password fields are not empty
		if(!empty($password) && !empty($rePassword)) {
			echo "<script>console.log( 'Entered both password not Empty' );</script>";
			if($password == $rePassword) {
				$matchPassword = true;
				$isUpdatePassword = true;
				echo "<script>console.log( 'Settting matchpassword and isUpdatePassword true ' );</script>";
			} else {
				echo"<script>console.log( 'There is mismatch in password' );</script>";
				$matchPassword = false;
			}
		}

		if(!empty($_POST[biographyInput])) {
			$isUpdateBiography = true;
		}
		if(!empty($_POST[emailInput])) {
			$isUpdateEmail = true;
		}

		//If no password reset is required
		if($matchPassword) {
			echo"<script>console.log( 'Entered matchassword' );</script>";
			if($isUpdatePassword) {
				$sqlUpdatePassword = updatePassword($db, $UNAME, $password);
				if(!$sqlUpdatePassword) {
					echo"<script>console.log( 'Error in update Password' );</script>";
				}
			}
			if($isUpdateEmail) {
				$sqlUpdateEmail = updateEmail($db, $UNAME, $email);
				if(!$sqlUpdateEmail) {
					echo"<script>console.log( 'Error in update Email' );</script>";
				}
			}
			if($isUpdateBiography) {
				$sqlUpdateBiography = updateBiography($db, $UNAME, $biography);
				if(!$sqlUpdateBiography) {
					echo "<script>alert('Update Biography');</script>";
				}
			}
			//Refresh after updating
			echo "<meta http-equiv='refresh' content='0'>";
		}
		else {
			echo "<script>alert('matchPassword not true');</script>";
		}
	}
?>

<?php
	//php for My Projects
	//Need to obtain My Project Info: Project Name/title, Project Id, Amt Raised , Target Amt, Status
	//First send the query to get the project List
	$projectListResult = getAllAdvertisedProjectsByEntrepreneur($db, $UNAME);
	$projectListSize = pg_num_rows($projectListResult);
	echo "<script>console.log( 'Project List size test is: " . $projectListSize . "' );</script>";
	$projectList = array();
	//extracts list from $result into 2d array
	$i=0;
	while($row = pg_fetch_assoc($projectListResult)){
		$projectList[$i] = $row;
		$i++;
	}
?>

<?php
	//php for My Investments
	//First send the query to get the investment List
	$investmentListResult = getAllInvestmentsOfInvestor($db, $UNAME);
	$investmentListSize = pg_num_rows($investmentListResult);
	echo "<script>console.log( 'Investment List size test is: " . $investmentListSize . "' );</script>";
	$investmentList = array();
	//extracts list from $result into 2d array
	$i=0;
	while($row = pg_fetch_assoc($investmentListResult)){
		$investmentList[$i] = $row;
		$i++;
	}
?>

<html>
	<head>
		<title>My Profile Page</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="img/favicon.png"/>
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
		<style>
			a.logout {
				color: white;
			}
			card {
				padding-top: 15px;
			}
		</style>
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-0">
			<div class="container">
				<div class="collapse navbar-collapse navMenu justify-content-between">
					<div class="row">
					<div class="col-6">
						<div class="d-flex justify-content-end justify-content-lg-start pt-1 pt-lg-0">
							<div class="dropdown">
								<button class="btn dropdown-toggle btn-dark btn-sm"  type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<img src="img/user.png" alt="user image" class="btn-image" width="60" height="40">
									<span>Welcome! <?php echo "$UNAME";?>
									</span>
								</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									<a class="dropdown-item" href="#">Profile</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-6">
						<div class="py-1 d-flex align-items-center justify-content-end">
							<ul class="navbar-nav d-flex flex-row">
								<li class="nav-item">
									<a href="home.php" class="text-small nav-link px-2">Explore</a>
								</li>
                <li class="nav-item">
                  <a href="createProject.php" class="text-small nav-link px-2">Start a New Project
                  </a>
                </li>
								<?php
                                    $isAdmin = isMemberAdmin($db, $UNAME);
                                    if($isAdmin){
                                        echo '<li class="nav-item">';
                                        echo '<a href="admin.php" class="text-small nav-link px-2">Admin';
                                        echo '</a>';
                                        echo '</li>';
                                    }
								?>
							</ul>
							<button class="btn btn-primary btn-sm" name="logout"><a href="../php/logout.php" class="logout">Logout</a></button>
						</div>
					</div>
					</div>
				</div>
			</div>
		</nav>
		<div class="container">
			<h2>Profile Page</h2>
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#home">My Profile</a></li>
				<li><a data-toggle="tab" href="#menu1">My Projects</a></li>
				<li><a data-toggle="tab" href="#menu2">My Investments</a></li>
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
								<textarea id="publicinfo" name="biographyInput" cols="40" rows="4" class="form-control"><?php echo "$rowBiography[0]"; ?></textarea>
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
					<?php foreach($projectList as $projectRow): ?>
						<form id="profileFormDeleteProject<?php echo $projectRow['id'];?>" action="../php/deleteProjectFromProfile.php" method="POST"></form>
					<?php endforeach; ?>
					<form action = "profile.php" method = "POST">
						<div class="form-group row">
							<div class="table-responsive">
								<table id="myProjectTable" class="table table-striped">
									<thead>
										<th style="text-align:left" width="150">Project Name</th>
										<th style="text-align:center" width="100">Project Id</th>
										<th style="text-align:center" width="100" >Amount Raised</th>
										<th style="text-align:center" width="100">Target Amount</th>
										<th style="text-align:center" width="50">Status</th>
										<th style="text-align:center" width="50">Edit</th>
										<th style="text-align:center" width="50">Delete</th>
									</thead>
									<tbody>
										<?php echo "<script> console.log('Iterating project') </script>"; ?>
										<?php foreach($projectList as $projectRow): ?>
											<tr>
												<td align="left" width="150"><?php echo $projectRow['title'];?></td>
												<td align="center" width="100"><?php echo $projectRow['id'];?></td>
												<td align="center" width="100"><?php echo $projectRow['amt_raised'];?></td>
												<td align="center" width="100"><?php echo $projectRow['amt_needed'];?></td>
												<td align="center" width="50"><?php echo ($projectRow['status']==0 ? "Ongoing" : "Fully Funded");?></td>
												<td align="center" width="50">
													<p data-placement="top" data-toggle="tooltip" title="Edit">
														<input type="button" style="background:url(img/edit.png) no-repeat; background-size:20px 20px; border:0; width:20px; height:20px;" data-title="Edit" data-toggle="modal" data-target="#modalForProject<?php echo $projectRow['id'];?>" >
														</input>
													</p>
												</td>
												<td align="center" width="50">
													<p data-placement="top" data-toggle="tooltip" title="Delete">
														<input type="hidden" name="projId" value="<?php echo $projectRow['id'];?>" form="profileFormDeleteProject<?php echo $projectRow['id'];?>">
														<input type="button" id="profileFormDeleteProjectButton<?php echo $projectRow['id'];?>" style="background:url(img/trash.png) no-repeat; background-size:20px 20px; border:0; width:20px; height:20px;" data-title="Delete" data-toggle="modal" >
													</p>
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</form>
					<?php foreach($projectList as $projectRow): ?>
						<!-- Modal Popup-->
						<div class="modal fade" id="modalForProject<?php echo $projectRow['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h3 class="modal-title"><?php echo $projectRow['title'];?></h3>
										<span class="close" aria-label="Close"><span aria-hidden="true">#<?php echo $projectRow['id'];?></span></span>
									</div>
									<div class="modal-body">
										<form action="../php/updateProjectFromProfile.php" method="POST" id="modalFormForProject<?php echo $projectRow['id'];?>">
											<input type="hidden" name="projectId" value="<?php echo $projectRow['id'];?>">
											<div class="form-group row">
												<label class="col-4 col-form-label">Description</label>
												<div class="col-8">
													<textarea name="descriptionInput" cols="40" rows="4" class="form-control"><?php echo $projectRow['description'];?></textarea>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-4 col-form-label">Category</label>
												<div class="col-8">
													<select class="btn btn-primary dropdown-toggle" id="categoryForProject<?php echo $projectRow['id'];?>" name="category" required>
														<option value="Fashion">Fashion</option>
								            <option value="Technology">Technology</option>
								            <option value="Games">Games</option>
								            <option value="Food">Food</option>
								            <option value="Music">Music</option>
								            <option value="Photography">Photography</option>
								            <option value="Handicraft">Handicraft</option>
								            <option value="Community">Community</option>
								          </select>
													<script>document.getElementById("categoryForProject<?php echo $projectRow['id'];?>").value = "<?php echo $projectRow['category'];?>";</script>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-4 col-form-label">Target Amount</label>
												<div class="col-8">
													<input name="targetAmount" class="form-control" value='<?php echo $projectRow['amt_needed'];?>'>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-4 col-form-label">Start Date</label>
												<div class="col-8">
													<input name="startDate" class="form-control" value='<?php echo $projectRow['start_date'];?>'>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-4 col-form-label">Duration</label>
												<div class="col-8">
													<input name="duration" class="form-control" value='<?php echo $projectRow['duration'];?>'>
												</div>
											</div>
										</form>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button id="modalButtonForProject<?php echo $projectRow['id'];?>" name="saveProject" type="submit" form="modalFormForProject<?php echo $projectRow['id'];?>" class="btn btn-primary" data-dismiss="modal">Save</button>
									</div>
								</div>
							</div>
						</div>
						<script>
							$("#modalButtonForProject<?php echo $projectRow['id'];?>").click(function (){
								var data = $("#modalFormForProject<?php echo $projectRow['id'];?>:input").serializeArray();
								document.getElementById("modalFormForProject<?php echo $projectRow['id'];?>").submit();
								$.post($("#modalFormForProject<?php echo $projectRow['id'];?>").attr("action"), data, function(info){} );
							});

							$("#modalFormForProject<?php echo $projectRow['id'];?>").submit(function() {
								return false;
							});

							$("#profileFormDeleteProjectButton<?php echo $projectRow['id'];?>").click(function (){
								if (confirm('Are you sure you want to permanently delete this project? All funds will be lost.')) {
									var data = $("#profileFormDeleteProject<?php echo $projectRow['id'];?>:input").serializeArray();
									document.getElementById("profileFormDeleteProject<?php echo $projectRow['id'];?>").submit();
									$.post( $("#profileFormDeleteProject<?php echo $projectRow['id'];?>").attr("action"), data, function(info){} );
						    } else {/*do nothing*/}
							});

							$("#profileFormDeleteProject<?php echo $projectRow['id'];?>").submit(function() {
								return false;
							});
						</script>
					<?php endforeach; ?>
				</div>
				<div id="menu2" class="tab-pane fade">
					<h3>My Investments</h3>
					<?php foreach($investmentList as $investmentRow): ?>
						<form id="profileFormDeleteInvestment<?php echo $investmentRow['proj_id'];?>" action="../php/deleteInvestmentFromProfile.php" method="POST"></form>
					<?php endforeach; ?>
					<form action = "profile.php" method = "POST">
						<div class="form-group row">
							<div class="table-responsive">
								<table id="myInvestmentTable" class="table table-striped">
									<thead>
										<th style="text-align:left" width="200">Project Name</th>
										<th style="text-align:center" width="50">Project Id</th>
										<th style="text-align:center" width="100">Amount Invested</th>
										<th style="text-align:center" width="100">Amount Raised</th>
										<th style="text-align:center" width="100">Target Amount</th>
										<th style="text-align:center" width="50">Status</th>
										<th style="text-align:center" width="50">Edit</th>
										<th style="text-align:center" width="50">Delete</th>
									</thead>
									<tbody>
										<?php foreach($investmentList as $investmentRow): ?>
											<tr>
												<td align="left" width="200"><?php echo $investmentRow['title'];?></td>
												<td align="center" width="50"><?php echo $investmentRow['proj_id'];?></td>
												<td align="center" width="100"><?php echo $investmentRow['amount'];?></td>
												<td align="center" width="100"><?php echo $investmentRow['amt_raised'];?></td>
												<td align="center" width="100"><?php echo $investmentRow['amt_needed'];?></td>
												<td align="center" width="50"><?php echo ($investmentRow['status']==0 ? "Ongoing" : "Fully Funded");?></td>
												<td align="center" width="50">
													<p data-placement="top" data-toggle="tooltip" title="Edit">
														<input type="button" style="background:url(img/edit.png) no-repeat; background-size:20px 20px; border:0; width:20px; height:20px;" data-title="Edit" data-toggle="modal" data-target="#modalForInvestment<?php echo $investmentRow['proj_id'];?>" >
													</p>
												</td>
												<td align="center" width="50">
													<p data-placement="top" data-toggle="tooltip" title="Delete">
														<input type="hidden" name="projId" value="<?php echo $investmentRow['proj_id'];?>" form="profileFormDeleteInvestment<?php echo $investmentRow['proj_id'];?>">
														<input type="button" id="profileFormDeleteInvestmentButton<?php echo $investmentRow['proj_id'];?>" style="background:url(img/trash.png) no-repeat; background-size:20px 20px; border:0; width:20px; height:20px;" data-title="Delete" data-toggle="modal" >
														</input>
													</p>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</form>
					<?php foreach($investmentList as $investmentRow): ?>
						<!-- Modal Popup-->
						<div class="modal fade" id="modalForInvestment<?php echo $investmentRow['proj_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h3 class="modal-title"><?php echo $investmentRow['title'];?></h3>
										<span class="close" aria-label="Close"><span aria-hidden="true">#<?php echo $investmentRow['proj_id'];?></span></span>
									</div>
									<div class="modal-body">
										<form action="../php/updateInvestmentFromProfile.php" method="POST" id="modalFormForInvestment<?php echo $investmentRow['proj_id'];?>">
											<input type="hidden" name="projectId" value="<?php echo $investmentRow['proj_id'];?>">
											<div class="form-group row">
												<label class="col-4 col-form-label">Amount Invested</label>
												<div class="col-8">
													<input name="amtInvested" cols="40" rows="4" class="form-control" value='<?php echo $investmentRow['amount'];?>'>
												</div>
											</div>
										</form>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button id="modalButtonForInvestment<?php echo $investmentRow['proj_id'];?>" name="saveInvestment" type="submit" form="modalFormForInvestment<?php echo $investmentRow['proj_id'];?>" class="btn btn-primary" data-dismiss="modal">Save</button>
									</div>
								</div>
							</div>
						</div>
						<script>
							$("#modalButtonForInvestment<?php echo $investmentRow['proj_id'];?>").click(function (){
								var data = $("#modalFormForInvestment<?php echo $investmentRow['proj_id'];?>:input").serializeArray();
								document.getElementById("modalFormForInvestment<?php echo $investmentRow['proj_id'];?>").submit();

								$.post($("#modalFormForInvestment<?php echo $investmentRow['proj_id'];?>").attr("action"), data, function(info){} );
								});

								$("#modalFormForInvestment<?php echo $investmentRow['proj_id'];?>").submit(function() {
									return false;
							});

							$("#profileFormDeleteInvestmentButton<?php echo $investmentRow['proj_id'];?>").click(function (){
								if (confirm('Are you sure you want to permanently delete this investment?')) {
									var data = $("#profileFormDeleteInvestment<?php echo $investmentRow['proj_id'];?>:input").serializeArray();
									document.getElementById("profileFormDeleteInvestment<?php echo $investmentRow['proj_id'];?>").submit();
									$.post( $("#profileFormDeleteInvestment<?php echo $investmentRow['proj_id'];?>").attr("action"), data, function(info){} );
						    } else {/*do nothing*/}
							});

							$("#profileFormDeleteInvestment<?php echo $investmentRow['proj_id'];?>").submit(function() {
								return false;
							});
						</script>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<script src="script/custom.js" type="text/javascript">
		</script>
	</body>
</html>
