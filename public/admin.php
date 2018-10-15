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
	$UNAME = $_SESSION['username'];
?>

<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
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
			 <div class="container" style="padding-top: 25px">
				<div class="row text-center mb-4">
				  <div class="col">
					<h2>Admin Page</h2>
				  </div>
				</div>
			 </div>
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
								<form id="myForm" action="../php/deleteMemberFromAdmin.php" method="POST">
									<input type="hidden" name="deletedUser" value="<?php echo $memberRow['username'];?>" id="hiddenForm">
									<button id="sub">Delete</button>
								</form>
								<!-- Button trigger modal -->
								<div class="btn btn-primary " style="background-color: #e7e7e7; color: black;"
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
		</section>
		<script src="script/custom.js" type="text/javascript">
		</script>
		<script>
		function displayPopupInformation(username,password,email,biography) {
			document.getElementById("modalCurUsername").value = username;
			document.getElementById("modalUsername").value = username;
			document.getElementById("modalPassword").value = password;
			document.getElementById("modalEmail").value = email;
			document.getElementById("modalBiography").value = biography;
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
		</script>
	</body>
</html>