<?php

if (POST) {
  $modelState = $app->bind([
    'name' => $match->regex('/^\s*([a-zA-Z]+)\s+([a-zA-Z]+)\s*$/', 'Fusha duhet te permbaj emrin dhe mbiemrin'),
    'email' => $match->email(),
    'password' => $match->regex('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', 'Passwordi i dhene nuk eshte valid'),
    'password2' => $match->equals('password'),
    'type' => $match->either(['student', 'teacher'], 'Zgjedhni njerin opcion')
  ]);

  if ($modelState->isValid()) {
    $app->users->create($modelState->model);
    return view('login', [
      'panel' => 'register'
    ]);
  } else {
    return view('login', [
      'panel' => 'register',
      'modelState' => $modelState
    ]);
  }
} else {
  return redirect('/login.php');
}