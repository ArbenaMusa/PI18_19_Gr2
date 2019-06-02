<?php

if (!$app->user->loggedIn()) {
  return redirect('/login.php');
}

$classId = fallback($_GET['id'], fallback($_COOKIE['last_class'], null));
$classData = null;
if ($classId) {
  $classData = $app->classes->find($classId);
}

if ($classData) {
  setcookie('last_class', $classId, time() + (1800), "/");
}

return view('classes', [
  'classData' => $classData
]);

?>
