<!DOCTYPE html>
<html>
<form class="form-horizontal" role="form" method="post" action="index.php">
  <h2> Create a new Project </h2>
	<div class="form-group">
		<label for="name" class="col-sm-2 control-label">Name of Project</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="name" name="title" placeholder="Project Title" value="">
		</div>
	</div>
	<div class="form-group">
		<label for="message" class="col-sm-2 control-label">Description of Project</label>
		<div class="col-sm-10">
			<textarea class="form-control" rows="4" name="description"></textarea>
		</div>
	</div>
  <div class="form-group">
		<label for="name" class="col-sm-2 control-label">Funds Required</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="name" name="amtNeeded" placeholder="Entered the required amount for investment" value="">
		</div>
	<div class="form-group">
    <div class="form-group">
      <label for="name" class="col-sm-2 control-label">Choose the Category of Project</label>
      <div class="col-sm-10">
        <label for="select_1">Select list:</label>
        <select class="form-control" id="select_1" name="category">
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
		<div class="col-sm-10 col-sm-offset-2">
			<input id="submit" name="submit" type="submit" value="Create" class="btn btn-primary">
		</div>
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
    $advertiseResult = pg_query($db, "INSERT INTO advertise(entrepreneur, amt_needed, amt_raised, status) VALUES('$username', '$_POST[amtNeeded]', '0', '0')")

    if($projectResult && $advertiseResult) {
      echo "<script>alert('Created Project Successfully');</script>";
    } else {
      echo "<script>alert('Error occured creating Project');</script>";
    }

    ?>
</html>
