<?php

if (!POST) {
  return redirect('/classes.php');
}

$model = $app->bind([
  'section' => $match->required('Section is required.'),
  'classId' => $match->required('Class ID is required.')
]);

if (!$model->isValid()) {
  $model->logErrors();
  return view('classes', [
    'message' => 'Fields are required.'
  ]);
}

$filename = saveUpload('attachment');
if (!$filename) {
  return view('classes', [
    'message' => 'Fields are required.'
  ]);
}

$friendlyname = $_FILES['attachment']['name'];
$teacherId = $app->user->id();

if(!$app->classes->addResource($model->classId, $teacherId, $filename, $friendlyname, $model->section)) {
  return view('classes', [
    'message' => 'There has been an error adding the resources.'
  ]);
}

return redirect('/classes.php', [
  'id' => $model->classId
]);

?>
