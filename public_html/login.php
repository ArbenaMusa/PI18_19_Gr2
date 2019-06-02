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

$result = $app->users->check($model->email, $model->password);


if ($result->isError) {
  $model->setError('status_l', $result->error);
  return view('login', [
    'panel' => 'login',
    'model' => $model
  ]);
}

$user = $result->value;

$app->user->logIn($user);
return redirect('/index.php');


?>
