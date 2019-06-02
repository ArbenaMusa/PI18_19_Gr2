<?php

if (!POST) {
  return redirect('/index.php');
}

$model = $app->bind([
  'assistant' => $match->email(),
  'classId' => $match->required()
]);

if (!$model->isValid()) {
  return view('classes', [
    'message' => 'Invalid email address.'
  ]);
}

if(!$app->db->exists('SELECT * FROM users WHERE email = %s AND type = "teacher"',$model->assistant)) {
  return view('classes', [
    'message' => 'That email doesnt exist in our system.'
  ]);
}

$assistant = $app->db->first('SELECT * FROM users WHERE email = %s', $model->assistant);

if(!$app->classes->addTeacher($assistant->id, $model->classId)) {
  return view('classes', [
    'message' => 'Selection could not be added. Please try again'
  ]);
}

return redirect('/classes.php', [
  'id' => $model->classId
]);

?>
