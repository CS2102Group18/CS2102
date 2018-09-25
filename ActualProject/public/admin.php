<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<?php
	session_start();
	if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == true) {
		include 'db.php';
		$queryUser = $_SESSION['username'];
		$result = pg_query($db, "SELECT is_admin FROM member WHERE username = '$queryUser' AND is_admin = 1");
		$rowAdmin = pg_num_rows($result);
		if($rowAdmin == 0){
			header("location:home.php");
		}
		else {
			echo "You're logged into the admin's area " . $_SESSION['username'] . "!";
		}
	} else {
		header("location:logout.php");
	}
	
	$result = pg_query($db, "SELECT * FROM member WHERE is_admin = 0");
	
	$UNAME = $_SESSION['username'];
	$project = array();
	$i=0;
	while($row = pg_fetch_assoc($result)){
		$project[$i] = $row;
		$i++;
	}
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
				<button class="btn btn-primary btn-sm" name="logout"><a href="logout.php" class="logout">Logout</a></button>
			  </div>
			</div>
		  </div>
		</nav>
		<section class="pb-0">
			 <div class="container">
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
						<?php foreach($project as $projectRow): ?>
							<tr>
							  <td><?php echo $projectRow['username'];?></td>
							  <td><?php echo $projectRow['email'];?></td>
							  <td>
								<form id="myForm" action="deleteMember.php" method="POST">
									<input type="hidden" name="deletedUser" value="<?php echo $projectRow['username'];?>" id="hiddenForm">
									<button id="sub">Delete</button>
								</form>
							  </td>
							</tr>
						<?php endforeach; ?>
					 </tbody>
					</table>
				</div>
				<div class="col-2">
				</div>
			</div>
		</section>
		<script src="script/custom.js" type="text/javascript">
		</script>
	</body>
</html>