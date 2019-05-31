<?php

$classId = $_GET['id'];

if (!$classId) {
  return view('error');
}

$query = <<<SQL
SELECT name, email
FROM users
INNER JOIN enrolled ON enrolled.studentId = users.id
WHERE enrolled.classId = %s
SQL;

$result = $app->db->query($query, $classId);

header('Content-type: text/csv');
header('Content-disposition: attachment;filename=Student_Emails.csv');
foreach ($result as $student) {
  echo "$student->name,$student->email" . PHP_EOL;
}

?>
