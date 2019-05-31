<?php

if (!POST) {
  return status(405);
}

if (!$app->user->loggedIn()) {
  return json([
    'error' => 'Not authenticated'
  ], 401);
}

$classId = fallback($_GET['id'], null);
if (!$classId) {
  return json([
    'error' => 'Invalid class id'
  ], 400);
}

$token = uniqid();
$userId = $app->user->id();

$query = <<<SQL
INSERT INTO invite(token, classId, creator, state)
VALUES('$token', %d, '$userId', 1)
SQL;

if (!$app->db->execute($query, $classId)) {
  return json([
    'error' => 'Error creating link'
  ], 500);
}

return json([
  'invite_id' => $token,
  'link' => siteURL() . '/classes_join.php?invite=' . $token
], 201);

?>
