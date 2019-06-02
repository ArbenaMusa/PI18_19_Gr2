<?php

if (!POST) {
  return redirect('index');
}

$model = $app->bind([
  'questionId' => $match->required(),
  'comment' => $match->required(),
  'classId' => $match->required()
]);

if(!$model->isValid()) {
  return view('classes', [
    'message' => 'Fields are required.'
  ]);
}

$authorId = $app->user->id();

if(!$app->classes->answer($model->questionId, $authorId, $model->comment, $model->classId)) {
  return view('classes', [
    'message' => 'There has been an error posting the question.'
  ]);
}

return redirect('classes.php', [
  'id' => $model->classId
]);

?>
