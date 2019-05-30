<?php

$model = $app->bind([
  'classname' => $match->required(),
  'semester' => $match->required(),
  'no_of_groups' => $match->integer()
]);

if(!$model->isValid()) {
  return view('classes', [
    'message' => 'Fill in the required fields',
    'panel' => 'popup'
  ]);
}

$result = $app->classes->create($model);
if($result->isError) {
  return view('classes', [
    'message' => 'There was an error creating the class',
    'panel' => 'popup'
  ]);
}

$classId = $result->value;
return redirect('/classes.php', [
  'id' => $classId
]);

?>
