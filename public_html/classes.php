<?php

$classId = fallback($_GET['id'], null);
return view('classes', [
  'classData' => $app->classes->find($classId)
]);

?>
