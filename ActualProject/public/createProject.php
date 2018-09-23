  <!DOCTYPE html>
  <html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      background-color: GhostWhite;
    }

    * {
      box-sizing: border-box;
    }

    /* Add padding to containers */
    .container {
      padding: 12px;
      background-color: lightgrey;
    }

    /* Overwrite default styles of hr */
    hr {
      border: 1px solid #f1f1f1;
      margin-bottom: 25px;
    }
    .p {
      padding: 10px;
    }

    /* Full-width input fields */
    input[type=text] ,.p{
      width: 120%;
      padding: 20px;
      margin: 25px 0 px 35 px 0 px;
      display: inline-block;
      border: none;
      background: #f1f1f1;
    }
    /* Set a grey background color and center the text of the "sign in" section */
    .signin {
      background-color: #f1f1f1;
      text-align: center;
    }
    .registerbtn:hover {
      opacity: 2;
    }
    .registerbtn {
      background-color: #4CAF50;
      color: black;
      padding: 16px 20px;
      margin: 25px 0;
      border: none;
      cursor: pointer;
      width: 120%;
      opacity: 0.9;
    }
    label {
      font-weight: bold;
    }
    input {
      padding: 20px;
    }
    .textboxarea , p{
      width: 98%;
      margin: 25px;
    }

    </style>
  </head>
  <form class="form-vertical" role="form" method="post" action="index.php">

    <h1> Create a new Project </h1>
      <p>Please fill in this form to create a new Project</p>

  	<div class="form-group">
  		<label for="name" class="col-sm-2 control-label">Name of Project</label>
  		<div class="col-sm-10">
  			<input type="text" class="form-control" id="name" name="title" placeholder="Project Title">
  		</div>
  	</div>
  	<div class="form-group">
  		<label for="message" class="col-sm-2 control-label">Description of Project</label>
  		<div class="textboxarea">
  			<textarea class="form-control" rows="4" name="description"></textarea>
  		</div>
  	</div>
    <div class="form-group">
  		<label for="name" class="col-sm-2 control-label">Funds Required</label>
  		<div class="col-sm-10">
  			<input type="text" class="form-control" id="name" name="amtNeeded" placeholder="Entered the required amount for investment" value="">
  		</div>
    </div>
  	<div class="form-group">
      <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Choose the Category of Project</label>
        <div class="col-sm-10">
          <select class="btn btn-primary dropdown-toggle" id="select_1" name="category">
            <option value="Fashion">Fashion</option>
            <option value="Technology">Technology</option>
            <option value="Games">Games</option>
            <option value="Food">Food</option>
            <option value="Music">Music</option>
            <option value="Photography">Photography</option>
            <option value="Handicraft">Handicraft</option>
            <option value="Community">Community</option>
        </select>
        <button type="submit" class="registerbtn" name = "Create">Register</button>

  	</div>
  	<div class="form-group">
  		<div class="col-sm-10 col-sm-offset-2">
  			<! Will be used to display an alert to the user>
  		</div>
  	</div>
  </form>

  <?php
  $session_start();
      $username = $_SESSION['user'];
      $db     = init_db();
      //Run the following 2 together
      $projectResult = pg_query($db, "INSERT INTO project(title, description, category) VALUES('$_POST[title]', '$_POST[description]', '$_POST[category]')");
      $advertiseResult = pg_query($db, "INSERT INTO advertise(entrepreneur, amt_needed) VALUES('$username', '$_POST[amtNeeded]')")


      // if($projectResult && $advertiseResult) {
      //   echo "<script>alert('Created Project Successfully');</script>";
      // }
      ?>
  </html>
