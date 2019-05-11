<?php

if (!$app->user->loggedIn()) {
  return redirect('/login.php');
}

if($app->user->type() == 'teacher') {
  return view('index_teacher');
} else {
  return view('index_student');
}

?>