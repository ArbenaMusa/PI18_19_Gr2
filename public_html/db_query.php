<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>SQL Query</title>
</head>
<body>
  <?php
  $query = "";
  if (POST) {
    $query = $_POST['query'];
  }
  ?>
  <form method="post" action="/db_query.php">
    <textarea name="query"><?= htmlentities($query) ?></textarea>
    <br />
    <input type="submit" value="Send" />
  </form>
  <br />
  <?php
  if (POST) {
    $result = $app->db->queryAssoc($query);
    if ($result == null) {
      echo 'Error: ' . $app->db->error();
    } else {
      echo '<table border="1">';
      $i = 0;
      foreach ($result as $row) {
        if ($i++ == 0) {
          echo '<tr>';
          foreach ($row as $key => $value) {
            echo '<th>' . htmlentities($key) . '</th>';
          }
          echo '</tr>';
        }

        echo '<tr>';
        foreach ($row as $key => $value) {
          echo '<td>' . htmlentities($value) . '</td>';
        }
        echo '</tr>';
      }
      echo '</table>';
    }
  }
  ?>
</body>
</html>
