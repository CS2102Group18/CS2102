<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="img/favicon.png"/>
  <style>
  body {
    font-family: Arial, Helvetica, sans-serif;
    background-color: black;
  }

  * {
    box-sizing: border-box;
  }

  /* Add padding to containers */
  .container {
    padding: 12px;
    background-color: white;
  }

  /* Full-width input fields */
  input[type=text], input[type=password] {
    width: 100%;
    padding: 20px;
    margin: 25px 0 25 px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
  }

  input[type=text]:focus, input[type=password]:focus {
    background-color: #ddd;
    outline: none;
  }

  /* Overwrite default styles of hr */
  hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
  }

  /* Set a style for the submit button */
  .registerbtn {
    background-color: #4CAF50;
    color: black;
    padding: 16px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
  }

  .registerbtn:hover {
    opacity: 2;
  }

  /* Add a blue text color to links */
  a {
    color: dodgerblue;
  }

  /* Set a grey background color and center the text of the "sign in" section */
  .signin {
    background-color: #f1f1f1;
    text-align: center;
  }

}
</style>

</head>
<body>
  <form action="createMember.php", method = "POST">
    <div class="container">
      <h1>Register Account for Crowd Funding</h1>
      <p>Please fill in this form to create an account.</p>
      <hr>
      <label for="User Name"><b>Username</b></label>
      <input type="text" placeholder="Enter Desired Username" name="username" required>

      <label for="password"><b>Password</b></label>
      <input type="password" placeholder="Enter Desired Password" name="password" required>

      <label for="passwordRepeat"><b>Repeat Password</b></label>
      <input type="password" placeholder="Repeat Password" name="passwordRepeat" required>
      <hr>

      <button type="submit" class="registerbtn" name = "submit">Register</button>
    </div>

    <div class="container signin">
      <p>Already have an account? <a href="login.php">Sign in</a>.</p>

    </div>


  </form>

</body>

<?php
include '../php/db.php';
include '../php/member.php';

if (isset($_POST['submit'])) {
  if ($_POST[password] == $_POST[passwordRepeat]){
    $sqlCheckUsername = pg_query($db, "SELECT * FROM member WHERE username = '$_POST[username]'");
    $numRows = pg_num_rows($sqlCheckUsername);

    if ($numRows > 0) {
		echo "<script>alert('There is already an existing user!');</script>";
	}
    else if ($numRows == -1) {
        echo "<script>console.log('Error Occured!');</script>";
    }
    else {
		if(createMember($db, $_POST[username], $_POST[password])) {
			echo "<script>alert('Created Account Successfully!');</script>";
		}
		else
			echo "<script>alert('Error Occured!');</script>";
    }
  }
  else {
      echo "<script>alert('Password does not match!');</script>";
  }
}

?>
</html>
