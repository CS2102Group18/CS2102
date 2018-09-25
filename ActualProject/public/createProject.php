<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<?php
include 'db.php';
session_start();
if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == true) {
  // echo "You're logged into the Profile's area " . $_SESSION['username'] . "!";
} else {
  header("location:login.php");
}
$UNAME = $_SESSION['username'];	//retrieve USERNAME
if(isset($_POST['Create'])) {
  //Run the following 2 together
  $getTitle = $_POST['title'];
  $getDescripton = $_POST['description'];
  $getCategory = $_POST['category'];
  $getFunds = $_POST['amtNeeded'];

  if(!empty($getTitle) && !empty($getDescripton) && !empty($getCategory) && !empty($getFunds)) {
    $projectResult = pg_query($db, "INSERT INTO project(title, description, category) VALUES('$getTitle', '$getDescripton', '$getCategory')");
    $advertiseResult = pg_query($db, "INSERT INTO advertise(entrepreneur, amt_needed) VALUES('$UNAME', '$getFunds')");
  }
}

// if($projectResult && $advertiseResult) {
//   echo "<script>alert('Created Project Successfully');</script>";
// }
?>
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
  a.logout {
    color: white;
  }
  card {
    padding-top: 15px;
  }
  * {
    box-sizing: border-box;
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
<form class="form-vertical" role="form" method="post" action="createProject.php">
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
            <?php
            include 'db.php';
            $queryUser = $_SESSION['username'];
            $resultAdmin = pg_query($db, "SELECT * FROM member WHERE username = '$queryUser' AND is_admin = 1");
            $rowAdmin = pg_num_rows($resultAdmin);
            if($rowAdmin > 0){
              echo '<li class="nav-item">';
              echo '<a href="admin.php" class="text-small nav-link px-2">Admin';
              echo '</a>';
              echo '</li>';
            }
            ?>
          </ul>
          <button class="btn btn-primary btn-sm" name="logout"><a href="logout.php" class="logout">Logout</a></button>
        </div>
      </div>
    </div>
  </nav>
  <h2> Create a new Project </h2>
  <p>Please fill in this form to create a new Project</p>
  <body>
    <div class="form-group">
      <label for="name" class="col-sm-2 control-label">Name of Project</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="name" name="title" placeholder="Project Title" required>
      </div>
    </div>
    <div class="form-group">
      <label for="message" class="col-sm-2 control-label">Description of Project</label>
      <div class="textboxarea">
        <textarea class="form-control" rows="4" name="description" required></textarea>
      </div>
    </div>
    <div class="form-group">
      <label for="name" class="col-sm-2 control-label">Funds Required</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="name" name="amtNeeded" placeholder="Entered the required amount for investment" required>
      </div>
    </div>
    <div class="form-group">
      <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Choose the Category of Project</label>
        <div class="col-sm-10">
          <select class="btn btn-primary dropdown-toggle" id="select_1" name="category" required>
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
      </div>
    </div>
  </body>
</form>
</html>
