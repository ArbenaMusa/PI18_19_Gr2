<?php

if (POST) {
  $model = $app->bind([
    'name' => $match->regex('/^\s*([a-zA-Z]+)\s+([a-zA-Z]+)\s*$/', 'Fusha duhet te permbaj emrin dhe mbiemrin'),
    'email' => $match->email(),
    'password' => $match->regex('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', 'Passwordi i dhene nuk eshte valid'),
    'password2' => $match->equals('password'),
    'type' => $match->either(['student', 'teacher'], 'Zgjedhni njerin opcion')
  ]);

  if ($model->isValid()) {
    $model->password = password_hash($model->password, PASSWORD_DEFAULT);
    $app->users->create($model->pluck(['name', 'email', 'password', 'type']));
    return view('login', [
      'panel' => 'register'
    ]);
  } else {
    return view('login', [
      'panel' => 'register',
      'model' => $model
    ]);
  }
} else {
  return redirect('/login.php');
}