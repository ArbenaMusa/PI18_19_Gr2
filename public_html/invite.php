<?php

if(!POST) {
  return redirect('/index.php');
}

$link = $_POST['invite'];
$file = $_FILES['file']['tmp_name'];

$rows = array_map('str_getcsv', file($file));

foreach($rows as $row) {
  $email = $row[0];
  $app->email->inviteEmail($link, $email);
}


?>
