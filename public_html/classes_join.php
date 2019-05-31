<?php

if (!$app->user->loggedIn()) {
  return redirect('/login.php');
}

$id = $_GET['invite'];
if(!$id) {
  return view('error', [
    'message' => 'Invalid link.'
  ]);
}

$query = <<<SQL
SELECT *
FROM invite
WHERE token = %s
SQL;

$token = $app->db->first($query, $id);

if(!$token || $token->state == 0) {
  return view('error', [
    'message' => 'Link may have been disabled.'
  ]);
}

$query2 = <<<SQL
INSERT INTO enrolled(studentId, classId)
VALUES (%s, %s)
SQL;

$userId = $app->user->id();

if(!$app->db->execute($query2, $userId, $token->classId)) {
  return view('error', [
    'message' => 'There has been an error in the database.'
  ]);
}

?>
