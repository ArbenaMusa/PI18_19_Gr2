<?php view('layout/main_header', [
    'title' => 'StuDB',
    'css' => '/static/css/class.css',
    'javascript' => '/static/js/class.js'
]);?>
<div style="padding-left:5%; padding-right:5%; padding-top:15px;">
  <?php view('layout/class_menu');?>
    <div class="class_view">
      <div class="class_menu">
        <ul>
          <li><a class="classA active" onclick="currentClass(1)">ClassInfo</a></li>
          <li><a class="classA" onclick="currentClass(2)">Q&A</a></li>
          <li><a class="classA" onclick="currentClass(3)">Resources</a></li>
        </ul>
      </div>
      <div class="content" style="display:block">
        <div class="info">
          <p class="left"><b>Professor: <span <?php if($app->user->type() == 'teacher') echo "contenteditable=\"true\"";?>><?php // variabla;?></span></b></p>
          <p class="right"><b>Professor Assistant: <span <?php if($app->user->type() == 'teacher') echo "contenteditable=\"true\"";?>><?php //variabla?></b></p>
        </div>
        <?php if($app->user->type() == 'teacher')
              {
                echo "<button class=\" right button1\">Change mentors</button>";
              }
        ?>
      </div>
      <div class="content"></div>
      <div class="content"></div>
    </div>
<div>
<div class="popup" id="popup">
  <div class="popup_inner">
    <div class="popup_text">
      <form action="/action_page.php">
        <label for="className">Class Name</label>
        <input type="text" id="className" name="className" placeholder="Class name.." required>
        <label for="semester">Semester</label>
        <input type="text" id="semester" name="Semester" placeholder="Semester.." required>
        <label for="no_of_groups">Number of groups</label></br>
        <input list="no_of_groups" name="no_of_gruops" placeholder="Number of groups..">
        <datalist id="no_of_groups" >
          <option value="1">
          <option value="2">
          <option value="3">
          <option value="4">
        </datalist>
        </br> </br>
        <input type="submit" value="Submit">
      </form>
    </div>
    <a href="" class="popup_close">X</a>
  </div>
</div>
