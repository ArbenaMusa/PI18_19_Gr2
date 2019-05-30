<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>SQL Query</title>
  <style>
  textarea {
    box-sizing: border-box;
    width: 100%;
    height: auto;
  }

  .textwrapper {
    margin: 3px 0;
    padding: 3px;
  }
  </style>
</head>
<body>
  <?php
  $query = "";
  if (POST) {
    $query = $_POST['query'];
  }
  ?>
  <form method="post" action="/db_query.php">
    <div class="textwrapper">
      <textarea name="query" rows="7"><?= htmlentities($query) ?></textarea>
    </div>
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
