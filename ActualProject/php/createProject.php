
<?sql
  function createProject($db, $title, $description, $category) {
    $projectResult = pg_query($db, "INSERT INTO project(title, description, category) VALUES('$_POST[title]', '$_POST[description]', '$_POST[category]')");
  }
?>
