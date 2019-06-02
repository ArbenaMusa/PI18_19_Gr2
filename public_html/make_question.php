<?php

if (!POST) {
  return redirect('index');
}

$model = $app->bind([
  'title' => $match->required(),
  'content' => $match->required(),
  'classId' => $match->required()
]);

if(!$model->isValid()) {
  return view('classes', [
    'message' => 'Fields are required.'
  ]);
}

$studentId = $app->user->id();

if(!$app->classes->makeQuestion($model->classId, $studentId, $model->title, $model->content)) {
  return view('classes', [
    'message' => 'There has been an error posting the question.'
  ]);
}

return redirect('classes.php', [
  'id' => $model->classId
]);

?>
