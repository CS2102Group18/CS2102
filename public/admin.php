<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<?php
    include '../php/member.php';
	session_start();
	if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == true) {
		include '../php/db.php';
		$queryUser = $_SESSION['username'];
		$isAdmin = isMemberAdmin($db, $queryUser);
		if(!$isAdmin){
			header("location:home.php");
		}
		else {
			//echo "You're logged into the admin's area " . $_SESSION['username'] . "!";
		}
	} else {
		header("location:../php/logout.php");
	}
	$UNAME = $_SESSION['username'];
	//Pagination Implementation
	$resultPage = getAllNonAdminMembers($db);
	$numrows = pg_num_rows($resultPage);
	//echo "num of rows = $numrows";
	// num of rows to show per page
	$rowsperpage = 10;
	$totalpages = ceil($numrows/$rowsperpage);
	//echo "total pages = $totalpages";
	if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
	   // cast var as int
	   $currentpage = (int) $_GET['currentpage'];
	} else {
	   // default page num
	   $currentpage = 1;
	} // end if

	// if current page is greater than total pages...
	if ($currentpage > $totalpages) {
	   // set current page to last page
	   $currentpage = $totalpages;
	} // end if
	// if current page is less than first page...
	if ($currentpage < 1) {
	   // set current page to first page
	   $currentpage = 1;
	} // end if

	// the offset of the list, based on current page
	$offset = ($currentpage - 1) * $rowsperpage;
	// get the info from the db
	$sql = "SELECT * FROM member WHERE is_admin = 0 ORDER BY username ASC LIMIT $rowsperpage OFFSET $offset";
	$result = pg_query($db, $sql);
	$member = array();
	$i=0;
	while($row = pg_fetch_assoc($result)){
		$member[$i] = $row;
		$i++;
	}

	$sql = "SELECT * FROM advertised_project";
	$result = pg_query($db, $sql);
	$project = array();
	$i=0;
	while($row = pg_fetch_assoc($result)){
		$project[$i]= $row;
		$i++;
	}
?>

<?php
	//Get all registered members
	$registeredMemberListResult = getAllRegisteredMembers($db);
	$registeredMemberListSize = pg_num_rows($registeredMemberListResult);
	$registeredMemberList = array();

	$i=0;
	while($row = pg_fetch_assoc($registeredMemberListResult)){
		$registeredMemberList[$i] = $row;
		$i++;
	}
?>

<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <link rel="icon" type="image/png" href="img/favicon.png"/>
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
			  <div class="d-flex justify-content-end justify-content-lg-start pt-1 pt-lg-0">
				<div class="dropdown">
				  <button class="btn dropdown-toggle btn-dark btn-sm"  type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<img src="img/user.png" alt="user image" class="btn-image" width="60" height="40">
					<span>Welcome! <?php echo "$UNAME";?>
					</span>
				  </button>
				  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					<a class="dropdown-item" href="profile.php">Profile</a>
				  </div>
				</div>
			  </div>
			  <div class="py-1 d-flex align-items-center justify-content-end">
				<ul class="navbar-nav d-flex flex-row">
				  <li class="nav-item">
					<a href="home.php" class="text-small nav-link px-2">Explore</a>
				  </li>
          <li class="nav-item">
            <a href="createProject.php" class="text-small nav-link px-2">Start a New Project
            </a>
          </li>
				   <li class="nav-item">
					<a href="admin.php" class="text-small nav-link px-2">Admin
					</a>
				  </li>
				</ul>
				<button class="btn btn-primary btn-sm" name="logout"><a href="../php/logout.php" class="logout">Logout</a></button>
			  </div>
			</div>
		  </div>
		</nav>
		<section class="pb-0">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
			  <li class="nav-item">
				<a class="nav-link active" id="editUsers-tab" data-toggle="tab" href="#editUsers" role="tab" aria-controls="editUsers" aria-selected="true">Edit Users</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" id="editProfile-tab" data-toggle="tab" href="#editProfile" role="tab" aria-controls="editProfile" aria-selected="false">Edit Projects</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" id="addUsers-tab" data-toggle="tab" href="#addUsers" role="tab" aria-controls="addUsers" aria-selected="false">Add Users</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" id="addProjects-tab" data-toggle="tab" href="#addProjects" role="tab" aria-controls="addProjects" aria-selected="false">Add Projects</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" id="report-tab" data-toggle="tab" href="#report" role="tab" aria-controls="report" aria-selected="false">Report Tab</a>
			  </li>
			</ul>
			<div class="tab-content" id="myTabContent">
			   <div class="tab-pane fade show active" id="editUsers" role="tabpanel" aria-labelledby="editUsers-tab">
				 <div class="row">
					<div class="col-2">
					</div>
					<div class="col-8">
					  <table class="table table-bordered">
						 <thead>
							<tr>
							  <th>Username</th>
							  <th>Email</th>
							  <th>Admin Action</th>
							</tr>
						 </thead>
						 <tbody>
							<?php foreach($member as $memberRow): ?>
								<tr>
								  <td><?php echo $memberRow['username'];?></td>
								  <td><?php echo $memberRow['email'];?></td>
								  <td>
									<form id="deleteMember<?php echo $memberRow['username'];?>" action="../php/deleteMemberFromAdmin.php" method="POST">
										<input type="hidden" name="deletedUser" value="<?php echo $memberRow['username'];?>">
										<div class="btn btn-primary " style="background-color: #e7e7e7; color: black; width:70px;" onClick="deleteMemberInAdmin('<?php echo $memberRow['username'];?>')">Delete</div>
									</form>
									<!-- Button trigger modal -->
									<div class="btn btn-primary " style="background-color: #e7e7e7; color: black;width:70px"
									data-toggle="modal" data-target="#exampleModalCenter"
									  onClick="displayPopupInformation('<?php echo $memberRow['username'];?>',
									  '<?php echo $memberRow['password'];?>',
									  '<?php echo $memberRow['email'];?>',
									  '<?php echo $memberRow['biography'];?>')">Edit</a>
									</div>
								</td>
								</tr>
							<?php endforeach; ?>

							<!-- Modal -->
							<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							  <div class="modal-dialog modal-dialog-centered" role="document">
								 <div class="modal-content">
									<div class="modal-header">
									  <h5 class="modal-title" id="exampleModalLongTitle">Edit User</h5>
									  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
										 <span aria-hidden="true">&times;</span>
									  </button>
									</div>
									<form action="../php/updateMemberFromAdmin.php" method="POST" id="modalFormPledge">
									<div class="modal-body">
										<div class="form-group" hidden="true">
											<input type="text" class="form-control" id="modalCurUsername" name="currentUser"
											value="">
										</div>
										<div class="form-group">
											<label for="usr">Username:</label>
											<input type="text" class="form-control" id="modalUsername" name="newUser"
											value="">
										</div>
										<div class="form-group">
											<label for="usr">Password:</label>
											<input type="text" class="form-control" id="modalPassword" name="newPassword"
											value="">
										</div>
										<div class="form-group">
											<label for="usr">Email:</label>
											<input type="text" class="form-control" id="modalEmail" name="newEmail"
											value="">
										</div>
										<div class="form-group">
											<label for="usr">Biography:</label>
											<input type="text" class="form-control" id="modalBiography" name="newBiography"
											value="">
										</div>
									</div>
									</form>
									<div class="modal-footer">
									  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									  <button type="submit" form="modalFormPledge" class="btn btn-primary" onClick="updateMemberInAdmin()">Save changes</button>
									</div>
								 </div>
							  </div>
							</div>
						 </tbody>
						</table>
					</div>
					<div class="col-2">
					</div>
				</div>
				<div class = "row" style="padding-top: 25">
				<div class="col-4">
				</div>
				<div class="col-4" style="text-align: center;">
					<?php
						/******  build the pagination links ******/
						// if not on page 1, don't show back links
						if ($currentpage > 1) {
						   // show << link to go back to page 1
						   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=1'><<</a> ";
						   // get previous page num
						   $prevpage = $currentpage - 1;
						   // show < link to go back to 1 page
						   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'><</a> ";
						} // end if
						// range of num links to show
						$range = 3;

						// loop to show links to range of pages around current page
						for ($x = ($currentpage - $range); $x < (($currentpage + $range)  + 1); $x++) {
						   // if it's a valid page number...
						   if (($x > 0) && ($x <= $totalpages)) {
							  // if we're on current page...
							  if ($x == $currentpage) {
								 // 'highlight' it but don't make a link
								 echo " [<b>$x</b>] ";
							  // if not current page...
							  } else {
								 // make it a link
								 echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$x'>$x</a> ";
							  } // end else
						   } // end if
						} // end for
						// if not on last page, show forward and last page links
						if ($currentpage != $totalpages) {
						   // get next page
						   $nextpage = $currentpage + 1;
							// echo forward link for next page
						   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>></a> ";
						   // echo forward link for lastpage
						   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'>>></a> ";
						} // end if
						/****** end build pagination links ******/
					?>
				</div>
				<div class="col-4">
				</div>
				</div>
			  </div>
			  <div class="tab-pane fade" id="editProfile" role="tabpanel" aria-labelledby="editProfile-tab">
			  	<div class="row">
					<div class="col-2">
					</div>
					<div class="col-8">
					  <table class="table table-bordered">
						 <thead>
							<tr>
							  <th>Project ID</th>
							  <th>Project Title</th>
							  <th>Admin Action</th>
							</tr>
						 </thead>
						 <tbody>
							<?php foreach($project as $projectRow): ?>
								<tr>
								  <td><?php echo $projectRow['id'];?></td>
								  <td><?php echo $projectRow['title'];?></td>
								  <td>
									<form id="deleteProject<?php echo $projectRow['id'];?>" action="../php/deleteProjectFromAdmin.php" method="POST">
										<input type="hidden" name="deletedProject" value="<?php echo $projectRow['id'];?>">
										<div class="btn btn-primary " style="background-color: #e7e7e7; color: black; width:70px;" onClick="deleteProjectInAdmin('<?php echo $projectRow['id'];?>')">Delete</div>
									</form>
									<!-- Button trigger modal -->
									<div class="btn btn-primary " style="background-color: #e7e7e7; color: black;width:70px"
									data-toggle="modal" data-target="#projectModalCenter"
									  onClick="displayProjectPopupInformation(
									  '<?php echo $projectRow['id'];?>',
									  '<?php echo $projectRow['entrepreneur'];?>',
									  '<?php echo $projectRow['title'];?>',
									  '<?php echo $projectRow['description'];?>',
									  '<?php echo $projectRow['category'];?>',
									  '<?php echo $projectRow['start_date'];?>',
									  '<?php echo $projectRow['duration'];?>',
									  '<?php echo $projectRow['amt_needed'];?>',
									  '<?php echo $projectRow['amt_raised'];?>',
									  '<?php echo $projectRow['status'];?>')">Edit</a>
									</div>
								</td>
								</tr>
							<?php endforeach; ?>

							<!-- Modal -->
							<div class="modal fade" id="projectModalCenter" tabindex="-1" role="dialog" aria-labelledby="projectModalCenterTitle" aria-hidden="true">
							  <div class="modal-dialog modal-dialog-centered" role="document">
								 <div class="modal-content">
									<div class="modal-header">
									  <h5 class="modal-title" id="exampleModalLongTitle">Edit Project</h5>
									  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
										 <span aria-hidden="true">&times;</span>
									  </button>
									</div>
									<form action="../php/updateProjectFromAdmin.php" method="POST" id="modalFormPledgeProject">
									<div class="modal-body">
										<div class="form-group">
											<label for="usr">Id:</label>
											<input type="text" class="form-control" id="modalProjectId" name="projectid"
											value="" readonly="true">
										</div>
										<div class="form-group">
											<label for="usr">Entrepreneur:</label>
											<input type="text" class="form-control" id="modalEntrepreneur" name="entrepreneur"
											value="">
										</div>
										<div class="form-group">
											<label for="usr">Title:</label>
											<input type="text" class="form-control" id="modalTitle" name="title"
											value="">
										</div>
										<div class="form-group">
											<label for="usr">Description:</label>
											<input type="text" class="form-control" id="modalDescription" name="description"
											value="">
										</div>
										<div class="form-group">
											<label for="usr">Category:</label>
                      <select class="custom-select mr-sm-2" id="modalCategory" name = "category">
                      <option value ="" selected hidden>Choose...</option>
                      <option value="Fashion">Fashion</option>
                      <option value="Technology">Technology</option>
                      <option value="Games">Games</option>
                      <option value="Food">Food</option>
                      <option value="Music">Music</option>
                      <option value="Photography">Photography</option>
                      <option value="Handicraft">Handicraft</option>
                      <option value="Community">Community</option>
                      </select>
										</div>
										<div class="form-group">
											<label for="usr">Start Date:</label>
											<input type="text" class="form-control" id="modalStartDate" name="startdate"
											value="" disabled>
										</div>
										<div class="form-group">
											<label for="usr">Duration:</label>
											<input type="text" class="form-control" id="modalDuration" name="duration"
											value="">
										</div>
										<div class="form-group">
											<label for="usr">Amount needed:</label>
											<input type="text" class="form-control" id="modalAmountNeeded" name="amountneeded"
											value="">
										</div>
										<div class="form-group">
											<label for="usr">Amount raised:</label>
											<input type="text" class="form-control" id="modalAmountRaised" name="amountraised"
											value="" disabled>
										</div>
										<div class="form-group">
											<label for="usr">Status:</label>
											<input type="text" class="form-control" id="modalStatus" name="status"
											value="" disabled>
										</div>
									</div>
									</form>
									<div class="modal-footer">
									  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									  <button type="submit" form="modalFormPledgeProject" class="btn btn-primary" onClick="updateMemberInAdmin()">Save changes</button>
									</div>
								 </div>
							  </div>
							</div>
						 </tbody>
						</table>
					</div>
					<div class="col-2">
					</div>
				</div>
			  </div>
			  <div class="tab-pane fade" id="addUsers" role="tabpanel" aria-labelledby="addUsers-tab">
				  <form id="addMemberForm"action="../php/addMemberFromAdmin.php" method="POST">
					  <div class="form-group row">
						<label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="inputUsername" placeholder="Username">
						</div>
					  </div>
					  <div class="form-group row">
						<label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
						<div class="col-sm-10">
						  <input type="password" class="form-control" name="inputPassword" placeholder="Password">
						</div>
					  </div>
					  <div class="form-group row">
						<label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
						<div class="col-sm-10">
						  <input type="email" class="form-control" name="inputEmail" placeholder="email@example.com">
						</div>
					  </div>
					  <div class="form-group row">
						<label for="inputBio" class="col-sm-2 col-form-label">Biography</label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="inputBio" placeholder="Put biography in here!">
						</div>
					  </div>
					  <button class="btn btn-primary" onClick="addMemberInAdmin()">Submit</button>
				 </form>
			  </div>
			  <div class="tab-pane fade" id="addProjects" role="tabpanel" aria-labelledby="addProjects-tab">
				  <form action="../php/addProjectFromAdmin.php" method="POST">
					  <div class="form-group row">
						<div class="col-auto my-1">
						<label class="mr-sm-2" for="inputEntrepreneur">Entrepreneur</label>
						  <select class="custom-select mr-sm-2" name="inputEntrepreneur" required>
							<option value="" selected hidden>Choose...</option>
							  <?php foreach($registeredMemberList as $registeredMemberRow): ?>
								 <option value="<?php echo $registeredMemberRow['username'];?>"><?php echo $registeredMemberRow['username'];?></option>
							  <?php endforeach; ?>
						  </select>
						</div>
					  </div>
					  <div class="form-group row">
						<label for="inputTitle" class="col-sm-2 col-form-label">Project Title</label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="inputTitle" placeholder="Project Title" required>
						</div>
					  </div>
					  <div class="form-group row">
						<label for="inputDescription" class="col-sm-2 col-form-label">Description</label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="inputDescription" placeholder="Description">
						</div>
					  </div>
					  <div class="col-auto my-1">
						  <label class="mr-sm-2" for="inputCategory">Category</label>
						  <select class="custom-select mr-sm-2" name="inputCategory" required>
							<option value ="" selected hidden>Choose...</option>
							<option value="Fashion">Fashion</option>
							<option value="Technology">Technology</option>
							<option value="Games">Games</option>
							<option value="Food">Food</option>
							<option value="Music">Music</option>
							<option value="Photography">Photography</option>
							<option value="Handicraft">Handicraft</option>
							<option value="Community">Community</option>
						  </select>
				    </div>
					  <!--
					  <div class="form-group row">
						<label for="inputStartDate" class="col-sm-2 col-form-label">Start Date</label>
						<div class="col-sm-10">
						  <input type="date" class="form-control" name="inputStartDate" placeholder="YYYY-MM-DD">
						</div>
					  </div>
					  -->
					  <div class="form-group row">
						<label for="inputDuration" class="col-sm-2 col-form-label">Duration</label>
						<div class="col-sm-10">
						  <input type="number" class="form-control" name="inputDuration" placeholder="Duration" required>
						</div>
					  </div>
					  <div class="form-group row">
						<label for="inputAmountNeeded" class="col-sm-2 col-form-label">Funds Needed</label>
						<div class="col-sm-10">
						  <input type="number" class="form-control" name="inputAmountNeeded" placeholder="Amount needed for funds" required>
						</div>
					  </div>
					  <button type="submit" class="btn btn-primary">Submit</button>
				 </form>
			 </div>
			 <div class="tab-pane fade" id="report" role="tabpanel" aria-labelledby="report-tab">
			 	<form action="../test/UnitTest/testGenerateReport.php" method="POST">
					<button type="submit" class="btn btn-primary">Generate Report</button>
				</form>
			 </div>
			</div>
		</section>
		<script>
		function displayPopupInformation(username,password,email,biography) {
			document.getElementById("modalCurUsername").value = username;
			document.getElementById("modalUsername").value = username;
			document.getElementById("modalPassword").value = password;
			document.getElementById("modalEmail").value = email;
			document.getElementById("modalBiography").value = biography;
		}

		function displayProjectPopupInformation(id,entrepreneur,title,description,category,startdate,duration,amtneeded,amtraised,status) {
			document.getElementById("modalProjectId").value = id;
			document.getElementById("modalEntrepreneur").value = entrepreneur;
			document.getElementById("modalTitle").value = title;
			document.getElementById("modalDescription").value = description;
			document.getElementById("modalCategory").value = category;
			document.getElementById("modalStartDate").value = startdate;
			document.getElementById("modalDuration").value = duration;
			document.getElementById("modalAmountNeeded").value = amtneeded;
			document.getElementById("modalAmountRaised").value = amtraised;
			document.getElementById("modalStatus").value = status;
		}
		function updateMemberInAdmin() {
			document.getElementById("modalFormPledge").submit();
			<?php
		       echo "console.log('Updating');";
			   echo "console.log('$_POST[newPassword]');";
			  // $update = pg_query($db, "UPDATE member SET username = '$_POST[newUser]', password = $_POST[newPassword], email = '$_POST[newEmail]', biography = '$_POST[newBiography]' WHERE username = '$_POST[currentUser]'");
			  //$row = pg_fetch_assoc($update);
			?>;
		 }
		 function updateProjectInAdmin() {
			 document.getElementById("modalFormPledgeProject").submit();
		 }

		 function deleteMemberInAdmin(memberName){
			 document.getElementById("deleteMember"+memberName).submit();
		 }
		 function deleteProjectInAdmin(project){
			 document.getElementById("deleteProject"+project).submit();
		 }
		 function addMemberInAdmin(){
			 document.getElementById("addMemberForm").submit();
		 }
		</script>
	</body>
</html>
