<?php

if ($app->user->loggedIn()) {
  return redirect('/index.php');
}

if (!POST) {
  return view('login', [
    'panel' => 'login'
  ]);
}

$model = $app->bind([
  'email' => $match->email(),
  'password' => $match->required('Please enter your password.')
]);

if (!$model->isValid()) {
  return view('login', [
    'panel' => 'login',
    'model' => $model
  ]);
}

$user = $app->users->check($model->email, $model->password);
if ($user) {
  // Login success
  $app->user->logIn($user);
  return redirect('/index.php');
}

// Login error
$model->setError('status', 'Email ose fjalëkalimi i gabuar.');
return view('login', [
  'panel' => 'login',
  'model' => $model
]);

?>
