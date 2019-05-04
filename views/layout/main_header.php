<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="/static/css/main.css">
    <title><?= fallback($title, 'Menaxhimi i studenteve') ?></title>
</head>
<body>
  <div>
    <a href="/home.php">Ballina</a>
    <?php
      if ($app->user->loggedIn()) {
        echo 'Welcome ' . $app->user->name();
      } else {
        echo '<a href="/login.php">Log in</a>';
      }
    ?>
  </div>
  <!-- <View> -->