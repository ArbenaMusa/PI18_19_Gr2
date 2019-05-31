<div class="vertical-menu">
  <?php
  if($app->user->type() == 'teacher') {
    echo "<a href=\"#popup\" class=\"active\">Create a class</a>";
    $classList = $app->classes->getTeacherClasses();
    if ($classList) {
      foreach ($classList as $row) {
        echo "<a href='/classes.php?id=$row->id'>$row->classname</a>";
      }
    } else {
      echo "<div>You do not have any classes</div>";
    }

  } else if ($app->user->type() == 'student') {
    $classList = $app->classes->getStudentClasses();
    if ($classList) {
      foreach ($classList as $row) {
        echo "<a href='/classes.php?id=$row->id'>$row->classname</a>";
      }
    } else {
      echo "<div>You are not part of any classes</div>";
    }

  }



  ?>
</div>
<!-- Create a class -->
<div class="popup" id="popup">
  <div class="popup_inner">
    <div class="popup_text">
      <form action="/classes_add.php" method="post">
        <label for="classname">Class Name</label>
        <input type="text" id="classname" name="classname" placeholder="Class name.." value="" required>
        <label for="semester">Semester</label>
        <input type="text" id="semester" name="semester" placeholder="Semester.." value="" required>
        <label for="no_of_groups">Number of groups</label></br>
        <input list="no_of_groups" name="no_of_groups" placeholder="Number of groups.." value="">
        <datalist id="no_of_groups" >
          <option value="1">
          <option value="2">
          <option value="3">
          <option value="4">
        </datalist>
        </br> </br>
        <input type="submit" value="Create">
      </form>
    </div>
    <a href="" class="popup_close">X</a>
  </div>
</div>
