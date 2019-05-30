<?php

interface IClassManager {
  public function create($data);
  public function getTeacherClasses();
  public function getStudentClasses();
  public function find($classId);
}

class SqlClassManager implements IClassManager {
  private $app;

  public function __construct($app) {
    $this->app = $app;
  }

  //TODO create
  public function create($data) {
    $app = $this->app;
    $db = $app->db;
    $query1 = <<< SQL
    INSERT INTO classes(classname, semester, no_of_groups)
    VALUES(%s, %s, %d)
SQL;

    $query2 = <<< SQL
    INSERT INTO teaches(teacherId, classId, role)
    VALUES(%d, %d, 'teacher')
SQL;

    if (!$db->execute($query1, $data->classname, $data->semester, $data->no_of_groups)) {
      return makeError('Error creating class ' . $db->error());
    }

    $classId = $db->insertedId();

    if(!$db->execute($query2, $app->user->id(), $classId)) {
      return makeError('Error creating teacher ' . $db->error());
    }

    return makeResult($classId);
  }

  public function getTeacherClasses() {
    $app = $this->app;
    $db = $app->db;
    $query = <<<SQL
    SELECT cls.id, cls.classname
    FROM classes cls
    INNER JOIN teaches t
    ON cls.id = t.classId
    WHERE t.teacherId = %d
    ORDER BY cls.id DESC
SQL;

    return $db->query($query, $app->user->id());
  }

  public function getStudentClasses() {
    $app = $this->app;
    $db = $app->db;
    $query = <<<SQL
    SELECT cls.id, cls.classname
    FROM classes cls
    INNER JOIN enrolled e ON cls.id = e.classId
    WHERE e.studentId = %d
    ORDER BY cls.id DESC
SQL;

    return $db->query($query, $app->user->id());
  }

  public function find($classId) {
    $app = $this->app;
    $db = $app->db;

    $query = <<<SQL
    SELECT cls.id AS classId, cls.classname, cls.semester, cls.no_of_groups, u.name AS teacherName
    FROM classes cls
    INNER JOIN teaches t ON cls.id = t.classId
    INNER JOIN users u ON t.teacherId = u.id
    WHERE cls.id = %d
SQL;

    return $db->first($query, $classId);
  }
}

?>
