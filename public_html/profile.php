<?php

if (!$app->user->loggedIn()) {
  return redirect('/login.php');
}

if (!POST) {
  return view('profile');
}

$model = $app->bind([
  'name' => $match->regex('/^\s*([a-zA-Z]+)\s+([a-zA-Z]+)\s*$/', 'Fusha duhet te permbaj emrin dhe mbiemrin'),
  'email' => $match->email(),
  'title' => $match->title()
]);

if (!$model->isValid()) {
  return view('profile', [
    'model' => $model
  ]);
}

$query = "UPDATE users(name, email, title) SET name = %s, email = %s, title = %s WHERE id = %d";
if(!$db->execute($query, $model->name, $model->email, $model->title, $app->user->id())) {
  return view('profile', [
    'error' => "There has been an error, please try again."
  ]);
}

return redirect('/profile.php');
?>
