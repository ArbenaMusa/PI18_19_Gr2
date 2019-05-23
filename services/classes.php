<?php

interface IClassManager {
  public function create($data);
  public function view();
}

class SqlClassManager implements IClassManager {

  public function __construct() {
    $db = $this->app->db;
  }

  //TODO create
  public function create($data) {
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

    $classId = $db->first("SELECT id FROM classes WHERE name = %s", $data->classname);

    if(!$db->execute($query2, $app->user->id(), $classId)) {
      return true;
    }
    return false;
  }

  public function viewList() {
    $query = <<<SQL
    SELECT classname
    FROM classes cls
    INNER JOIN teaches t
    ON cls.id = t.classId
    WHERE t.teacherId = %s
SQL;

    return $db->query($query, $app->user->id());
  }
}

?>
