
<?sql
  function createProject($db, $username, $amtNeeded) {
      $advertiseResult = pg_query($db, "INSERT INTO advertise(entrepreneur, amt_needed) VALUES('$username', '$_POST[amtNeeded]')")
  }
?>
