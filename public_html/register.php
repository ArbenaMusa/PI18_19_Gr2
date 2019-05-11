<?php

if (!POST) {
  return redirect('/login.php');
}

$model = $app->bind([
  'name' => $match->regex('/^\s*([a-zA-Z]+)\s+([a-zA-Z]+)\s*$/', 'Fusha duhet te permbaj emrin dhe mbiemrin'),
  'email' => $match->email(),
  'password' => $match->regex('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', 'Passwordi i dhene nuk eshte valid'),
  'password2' => $match->equals('password'),
  'type' => $match->either(['student', 'teacher'], 'Zgjedhni njerin opcion')
]);

if (!$model->isValid()) {
  return view('login', [
    'panel' => 'register',
    'model' => $model
  ]);
}

$model->password = password_hash($model->password, PASSWORD_DEFAULT);
$error = $app->users->create($model->without(['password2']));
if ($error) {
  $model->setError('email', 'Kjo email eshte e perdorur.');
  return view('login', [
    'panel' => 'register',
    'model' => $model
  ]);
}

return view('login', [
  'panel' => 'register'
]);

