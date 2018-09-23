	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<html>
		<head>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
						<span>Welcome! User</span>
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
					</ul>
					<a href="logout.php">
						<button class="btn btn-primary btn-sm" name="logout">Logout</button>
					</a>
				  </div>
				</div>
			  </div>
			</nav>
			<section class="pb-0">
			  <div class="container">
				<div class="row text-center mb-4">
				  <div class="col">
					<h2>Entrepreneur Projects</h2>
				  </div>
				</div>
				<div class="row">
				  <div class="col-12 col-md-4">
					<div class="card">
					  <div class="card-body py-3">
						<h5>Stub Project 1</h5>
						<div class="mb-4">
						  <p>Description 1</p>
						</div>
					  </div>
					  <div class="card-footer">
						<div class="d-flex align-items-center justify-content-between">
						  <a href="pages-landing.html">Invest</a>
						</div>
					  </div>
					</div>
				  </div>
				  <div class="col-12 col-md-4">
					<div class="card">
					  <div class="card-body py-3">
						<h5>Stub Project 2</h5>
						<div class="mb-4">
						  <p>Description 2</p>
						</div>
					  </div>
					  <div class="card-footer">
						<div class="d-flex align-items-center justify-content-between">
						  <a href="pages-inner.html">Invest</a>
						</div>
					  </div>
					</div>
				  </div>
				  <div class="col-12 col-md-4">
					<div class="card">
					  <div class="card-body py-3">
						<h5>Stub Project 3</h5>
						<div class="mb-4">
						  <p>Description 3</p>
						</div>
					  </div>
					  <div class="card-footer">
						<div class="d-flex align-items-center justify-content-between">
						  <a href="pages-utility.html">Invest</a>
						</div>
					  </div>
					</div>
				  </div>
				</div>
			  </div>
			</section>
		</body>
		?>
		<?php
			session_start();
			$UNAME = $_SESSION['username'];	//retrieve USERNAME
			include 'db.php';
		 	$db = init_db();
			$currentId = '0';

		 	//Get list of advertise with query: entrepreneu, proj_id, amt_needed, amt_raised, status
		 	$result = pg_query($db, "SELECT * FROM advertise");
		 	$rows = pg_fetch_assoc($result);

			if(!result) {
				echo "Unable to retrieve result";
			}


			//Loop through the rows then assign the value required into the list of project.

			//Using the proj_id, find the required Project Name and Description and category
			//Use this Example query: Replace $currentId with value obtained previously. Other details you may require are : start_date
			$resultProjId = pg_query($db, "SELECT title, description, category FROM project WHERE id = $currentId");

			//Display the Project, Description, amt_needed, amt_raised, category, status through looping




		 ?>
	</html>
