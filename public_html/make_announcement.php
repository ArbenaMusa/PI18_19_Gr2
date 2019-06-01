<?php

if (!POST) {
  return redirect('index');
}

$model = $app->bind([
  'tag' => $match->required(),
  'title' => $match->required(),
  'content' => $match->required(),
  'classId' => $match->required()
]);

if(!$model->isValid()) {
  return view('classes', [
    'message' => 'Fields are required.'
  ]);
}

$teacherId = $app->user->id();

if(!$app->classes->makeAnnouncement($model->classId, $teacherId, $model->tag, $model->title, $model->content)) {
  return view('classes', [
    'message' => 'There has been an error making the announcement.'
  ]);
}

return redirect('classes.php', [
  'id' => $model->classId
]);

?>
