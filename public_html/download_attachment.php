<?php

if (!$app->user->loggedIn()) {
  return redirect('/login.php');
}

$file = fallback($_GET['file'], null);
if (!$file) {
  return view('error');
}

$info = $app->db->first('SELECT * FROM resources WHERE filepath = %s', $file);
if (!$info) {
  return view('error');
}

$mimeType = mime_content_type($file);
header('Content-type: ' . $mimeType);
header('Content-disposition: attachment;filename=' . fallback($info->name, $file));
return readfile(__DIR__ . '/../uploads/' . $file);

?>
