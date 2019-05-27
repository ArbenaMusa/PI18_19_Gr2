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
if ($error == 1) {
  $model->setError('email', 'This email is already used.');
  return view('login', [
    'panel' => 'register',
    'model' => $model
  ]);
} else if ($error == 2) {
  $model->setError('status_r', 'Theres been an error. Please try again.');
  return view('login', [
    'panel' => 'register',
    'model' => $model
  ]);
}

$id = uniqid();
$expireTime = time() + 3600;

$query = <<<SQL
INSERT INTO tokens(token, email, expires, state, type)
VALUES('$id', %s, $expireTime, 0, 'verify_email')
SQL;

if(!$app->db->execute($query, $model->email)) {
  return view('error', [
    'message' => 'There has been an error in the database.' . $app->db->error()
  ]);
}

if(!$app->email->verifyEmail($model, $id)) {
  return view('register', [
    'message' => 'There has been an error with the registration, please try again.'
  ]);
}

return view('login', [
  'panel' => 'register',
  'message' => 'Account registered successfully.'
]);
