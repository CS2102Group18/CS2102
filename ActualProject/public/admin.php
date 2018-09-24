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
	$UNAME = $_SESSION['username'];
?>

<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<style>
			a.logout {
				color: white;
			}
			card {
				padding-top: 15px;
			}
		</style>
	</head>
	  <form = "form-vertical" method="post" action="home.php">
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
					<a class="dropdown-item" href="#">Profile</a>
				  </div>
				</div>
			  </div>
			  <div class="py-1 d-flex align-items-center justify-content-end">
				<ul class="navbar-nav d-flex flex-row">
				  <li class="nav-item">
					<a href="documentation/index.html" class="text-small nav-link px-2">Explore</a>
				  </li>
				  <li class="nav-item">	
					<a href="documentation/changelog.html" class="text-small nav-link px-2">My Investments
					</a>
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
				<h2>Admin Page asd</h2>
			  </div>
			</div>
		 </div>
		</section>
	</body>
</html>