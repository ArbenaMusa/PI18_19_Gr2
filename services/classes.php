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

  public function makeAnnouncement($classId, $teacherId, $tag, $title, $content) {
    $app = $this->app;
    $db = $app->db;
    $date = date('Y-m-d H:i:s');

    $query = <<<SQL
    INSERT INTO announcements(classId, teacherId, tag, title, content, time)
    VALUES(%s, %s, %s, %s, %s, '$date')
SQL;

    return $db->execute($query, $classId, $teacherId, $tag, $title, $content);
  }

  public function getAnnouncements($classId) {
    $app = $this->app;
    $db = $app->db;

    $query = <<<SQL
    SELECT *
    FROM announcements
    WHERE classId = %s
    ORDER BY time DESC
SQL;

    return $db->query($query, $classId);
  }

//---------------------------------Q&A-------------------------------------
  public function makeQuestion($classId, $studentId, $title, $content) {
    $app = $this->app;
    $db = $app->db;
    $date = date('Y-m-d H:i:s');

    $query = <<<SQL
    INSERT INTO questions(classId, studentId, title, content, time)
    VALUES(%s, %s, %s, %s, "$date")
SQL;

    $db->execute($query, $classId, $studentId, $title, $content);
  }

  public function getQuestions($classId) {
    $app = $this->app;
    $db = $app->db;

    $query = <<<SQL
    SELECT *
    FROM questions
    INNER JOIN users ON questions.studentId = users.Id
    WHERE classId = %s
    ORDER BY time DESC
SQL;

    return $db->query($query, $classId);
  }

  //--------------------Answers-----------------------------
  public function answer($questionId, $authorId, $comment, $classId) {
    $app = $this->app;
    $db = $app->db;
    $date = date('Y-m-d H:i:s');

    $query = <<<SQL
    INSERT INTO questions(questionId, authorId, comment, classId, time)
    VALUES(%s, %s, %s, %s, "$date")
SQL;

    return $db->execute($query, $questionId, $authorId, $comment, $classId);
  }

  public function addResource($classId, $teacherId, $filepath, $name, $section) {
    $app = $this->app;
    $db = $app->db;

    $query = <<<SQL
    INSERT INTO resources(classId, teacherId, name, filepath, section)
    VALUES (%s, %s, %s, '$filepath', %s)
SQL;

    return $app->db->execute($query, $classId, $teacherId, $name, $section);
  }

  /*
  public function getAnswers($classId) {
    $app = $this->app;
    $db = $app->db;

    $query = <<<SQL
    SELECT *
    FROM answers
    INNER JOIN users ON questions.studentId = users.Id
    WHERE classId = %s
    ORDER BY time DESC
SQL;

    return $db->query($query, $classId);
  }
  */
}

?>
