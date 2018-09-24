<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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

  // $sqlUpdateEmail = pg_query($db, updateEmail($db, $UNAME, $email));
  //If no password reset is required
  if($matchPassword) {
    echo"<script>console.log( 'Entered matchassword' );</script>";
    if($isUpdatePassword) {
      $sqlUpdatePassword = pg_query($db, "UPDATE member SET password='$password' WHERE username='$UNAME'");
      if(!$sqlUpdatePassword) {
        echo"<script>console.log( 'Error in update Password' );</script>";
      }
    }
    if($isUpdateEmail) {
      $sqlUpdateEmail = pg_query($db, "UPDATE member SET email='$email' WHERE username='$UNAME'");
      if(!$sqlUpdateEmail) {
        echo"<script>console.log( 'Error in update Email' );</script>";
      }
    }
    if($isUpdateBiography) {
      $sqlUpdateBiography = pg_query($db, "UPDATE member SET biography='$biography' WHERE username='$UNAME'");
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
              <a class="dropdown-item" href="#">Profile</a>
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
  <div class="container">
    <h2>Profile Page</h2>
    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#home">My Profile</a></li>
      <li><a data-toggle="tab" href="#menu1">My Project & Investments</a></li>
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
        <form action = "profile.php", method = "POST">
          <div class="form-group row">
            <div class="table-responsive">
              <table id="myProjectTable" class="table table-striped">
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
        </form>
      </div>
    </div>
  </div>
</body>
</html>
