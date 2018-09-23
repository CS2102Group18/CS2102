
<?sql
  function createMember($db, $username, $password) {
    $sqlInsert = pg_query($db, "INSERT INTO member(username, password, is_admin) VALUES ('$_POST[username]', '$_POST[password]', '0' )");
  }
?>
