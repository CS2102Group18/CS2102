<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
  body {font-family: Arial, Helvetica, sans-serif;}
  form {border: 3px solid #f1f1f1;}

  input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
  }

  button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
  }

  button:hover {
    opacity: 0.8;
  }

  .cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
  }

  .imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
  }

  img.avatar {
    width: 40%;
    border-radius: 50%;
  }

  .container {
    padding: 16px;
  }

  span.psw {
    float: right;
    padding-top: 16px;
  }

  /* Change styles for span and cancel button on extra small screens */
  @media screen and (max-width: 300px) {
    span.psw {
      display: block;
      float: none;
    }
    .cancelbtn {
      width: 100%;
    }
  }
</style>
</head>
<body>

  <h2>Login Form</h2>

  <form action="home.php">
    <div class="imgcontainer">
      <img src="img/login.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>

      <button type="submit" name = "Login">Login</button>
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
  </form>

</body>
<?php
session_start();

$user = $_SESSION['user'];

$db = init_db();

$userResult = pg_query($db, "SELECT username FROM member WHERE username='$_POST[uname]' AND password = '$_POST[psw]'");
$isAdminResult = pg_query($db, "SELECT isAdmin FROM member WHERE username = '$_POST[uname]' AND password = '$_POST[psw]'");

if isset($POST['Login']) {
  $userRow = pg_fetch_assoc($userResult);
  $userFound = pg_num_rows($userResult);

  if ($userFound < 1) {
		$panelMsg = "Invaild Usernname or Password";
	} else {
    if($isAdmin == '1') {

    } else {
      $_SESSION['user'] = $_POST[uname];

    }
  }
}
?>
</html>
