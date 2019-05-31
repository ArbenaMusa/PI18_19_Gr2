<?php

if (!$app->user->loggedIn()) {
  return redirect('/login.php');
}

$user = $app->users->find($app->user->email());

if (!$user) {
  return view('error');
}

if (!POST) {
  $success = !!fallback($_GET['success'], false);
  return view('profile', [
    'user' => $user,
    'success' => $success
  ]);
}

$model = $app->bind([
  'name' => $match->regex('/^\s*([a-zA-Z]+)\s+([a-zA-Z]+)\s*$/', 'Name and Surname required'),
  'title' => $match->title()->optional(),
  'website' => $match->website()->optional(),
  'phone' => $match->phone()->optional()
]);

if (!$model->isValid()) {
  logError('Invalid profile data: ' . implode($model->errors(), '; '));
  return view('profile', [
    'model' => $model,
    'message' => 'Information you entered is not valid.',
    'user' => $user
  ]);
}

$query = <<<SQL
UPDATE users
SET name = %s, title = %s, website = %s, phone = %s
WHERE id = %d
SQL;

$userId = $app->user->id();

if(!$app->db->execute($query, $model->name, $model->title, $model->website, $model->phone, $userId)) {
  return view('profile', [
    'message' => 'There has been an error, please try again.',
    'user' => $user
  ]);
}

$user = $app->users->find($app->user->email());
$app->user->login($user);

return redirect('/profile.php', [
  'success' => 1
]);

?>
