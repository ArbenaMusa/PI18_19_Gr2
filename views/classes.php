<?php view('layout/main_header', [
    'title' => 'StuDB',
    'css' => '/static/css/class.css',
    'javascript' => '/static/js/class.js'
]);?>
<div style="padding-left:5%; padding-right:5%; padding-top:15px;">
  <?php
  view('layout/class_menu');

  if(!$classData) {
    return view('empty_class');
  }
  ?>

    <div class="class_view">
      <div class="class_menu">
        <ul>
          <li><a class="classA active" onclick="currentClass(1)">ClassInfo</a></li>
          <li><a class="classA" onclick="currentClass(2)">Q&A</a></li>
          <li><a class="classA" onclick="currentClass(3)">Resources</a></li>
          <li><a class="classA" onclick="currentClass(4)">Private Chat</a></li>
        </ul>
      </div>
      <div class="content" style="display:block">
        <div class="clearfix">
          <div class="box">
            <p><b>Professor: <?= $classData->teacherName ?></b></p>
          </div>
          <div class="box">
            <p><b>Assistant Professor: <?php //variabla ?></b></p>
          </div>
        </div>
        <?php if($app->user->type() == 'teacher')
              {
                echo "<a href=\"#popup2\" class=\"button1\" style=\"float:left; text-decoration:none; margin-left:40px;\">Add an announcement</a>";
                echo "<a href=\"#popup1\" class=\"button1\" style=\"text-decoration:none; margin-right:40px;\">Change mentors</a>";
              }
        ?></br></br>
        <div class="clearfix1">
          <!--shfaqen lajmet -->
        </div>
      </div>
      <div class="content"></div>
      <div class="content">
        <?php if($app->user->type() == 'teacher')
              {
                echo "<a href=\"#popup4\" class=\"button1\" style=\"float:left; text-decoration:none; margin-left:40px;\">Add resources</a>";
              }
        ?></br></br>
        <div class="clearfix2">
          <!--shfaqen resurset -->
        </div>
      </div>
      <div class="content"></div>
    </div>
<div>
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
<div class="popup" id="popup0">
  <div class="popup_inner">
    <div class="popup_text">
      <form action="#" method="post">
        <label for="className">Class Name</label></br>
        <input list="className" name="className" placeholder="Class Name.." value="">
        <datalist id="className">
          <!-- values from class database -->
          <option value="class1">
          <option value="class2">
          <option value="class3">
          <option value="class4">
        </datalist>
        </br></br>
        <label for="students">Students</label></br>
        <input type="text" id="students" name="students" placeholder="Students.." value="" required>
        <input type="submit" value="Invite">
      </form>
    </div>
    <a href="" class="popup_close">X</a>
  </div>
</div>
<div class="popup" id="popup1">
  <div class="popup_inner">
    <div class="popup_text">
      <form action="#" method="post">
        <label for="professor">Professor</label>
        <input type="text" id="professor" name="professor" placeholder="Professor.." value="">
        <label for="assistant">Assistant Professor</label>
        <input type="text" id="assistant" name="assistant" placeholder="Assistant Professor.." value="">
        <input type="submit" value="Change">
      </form>
    </div>
    <a href="" class="popup_close">X</a>
  </div>
</div>
<div class="popup" id="popup2">
  <div class="popup_inner">
    <div class="popup_text">
      <form action="#" method="post">
        <label for="subject">Subject</label>
        <input type="text" id="subject" name="subject" placeholder="Subject.." value="" required>
        <label for="content">Content</label>
        <textarea rows="4" cols="50" id="content" name="content" placeholder="Content.." value=""></textarea>
        <label for="hashtags">Hashtags</label></br>
        <input type="text" id="hashtags" name="hashtags" placeholder="Hashtags.." value="" required>
        <label for="attachment">PDF Attachment</label></br>
        <input type="file" id="attachment" name="attachment" accept=".pdf" value="" multiple></br>
        <label for="picture">Picture</label></br>
        <input type="file" id="picture" name="picture" accept="image/*" value="" multiple>
        </br>
        <input type="submit" value="Publish">
      </form>
      <a href="" class="popup_close">X</a>
    </div>
  </div>
</div>
<div class="popup" id="popup3">
  <div class="popup_inner">
    <div class="popup_text">
      <form action="#" mathod="post">

        <input type="submit" value="Group">
      </form>
    </div>
    <a href="" class="popup_close">X</a>
  </div>
</div>
<div class="popup" id="popup4">
  <div class="popup_inner">
    <div class="popup_text">
      <form action="#" method="post">
        <label for="section">Section</label>
        <input list="section" name="section" placeholder="Section.." value="">
        <datalist id="section">
          <option value="lecture material">
          <option value="material of exercises">
          <option value="web resources">
          <option value="homework">
        </datalist>
        </br> </br>
        <label for="attachment">PDF Attachment</label></br>
        <input type="file" id="attachment" name="attachment" accept=".pdf" value="" multiple></br>
        <input type="submit" value="Add resources">
      </form>
      <a href="" class="popup_close">X</a>
    </div>
  </div>
</div>
