<div class="vertical-menu">
  <?php
  if($app->user->type() == 'teacher') {
    echo "<a href=\"#popup\" class=\"active\">Create a class</a>";
    echo "<a href=\"#popup0\" class=\"active\">Invite Students</a>";
    echo "<a href=\"#popup3\" class=\"active\">Group Students</a>";
    $classList = $app->classes->getTeacherClasses();
    foreach ($classList as $row) {
      echo "<a href='/classes.php?id=$row->id'>$row->classname</a>";
    }
  } else if ($app->user->type() == 'student') {
    $classList = $app->classes->getStudentClasses();
    foreach ($classList as $row) {
      echo "<a href='/classes.php?id=$row->id'>$row->classname</a>";
    }
  }



  ?>
</div>
