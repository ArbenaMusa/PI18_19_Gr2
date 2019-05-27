<?php

$id = $_GET['id'];
if(!$id) {
  return view('error', [
    'message' => 'Invalid link.'
  ]);
}

$query = <<<SQL
SELECT *
FROM tokens
WHERE token = %s
SQL;

$token = $app->db->first($query, $id);

if(!$token || time() > $token->expires || $token->type != 'verify_email' || $token->state == 1) {
  return view('error', [
    'message' => 'Link has expired or has been used.'
  ]);
}

$query2 = <<<SQL
UPDATE users
SET verified = 1
WHERE email = %s;

UPDATE tokens
SET state = 1
WHERE token = %s
SQL;

if(!$app->db->execute($query2, $token->email, $token->token)) {
  return view('error', [
    'message' => 'There has been an error in the database.'
  ]);
}

return view('login', [
  'message' => 'Email has been verified, please log in.'
])

?>
