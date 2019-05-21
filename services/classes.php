<?php

interface IClassManager {
  public function create($data);
}

class SqlClassManager implements IClassManager {
  public function create($data) {
    $db = $this->app->db;

    $query1 = <<< SQL
    INSERT INTO class(classname, semester, no_of_groups)
    VALUES(%s, %s, %d)
SQL;

    $query2 = <<< SQL
    INSERT INTO teaches(teacherId, classId)
    VALUES(%d, %d)
SQL;


    if(!$db->execute($query1, $data->classname, $data->semester, $data->no_of_groups)) {
      return true;
    }

    $teacherId = $db->first("SELECT id FROM users WHERE name = %s", $data->teacher);
    $classId = $db->first("SELECT id FROM classes WHERE name = %s", $data->classname);

    if(!$db->execute($query2, $teacherId, $classId)) {
      return true;
    }
    return false;
  }
}

?>
