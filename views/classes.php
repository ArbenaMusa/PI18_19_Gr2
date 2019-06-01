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
          <?php if($app->user->type() == 'teacher')
          {
            echo "<li><a class=\"classA\" onclick=\"currentClass(4)\">StudentData</a></li>";
          }
          ?>
        </ul>
      </div>
      <!-- Class Info -->
      <div class="content" style="display:block" id="ClassInfo">
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
                echo "<script src='/static/js/invite.js'></script>";
                echo "<a href=\"#popup2\" class=\"button1\" style=\"float:left; text-decoration:none; margin-left:40px;\">Add an announcement</a>";
                echo "<a href=\"#popup1\" class=\"button1\" style=\"text-decoration:none; margin-right:40px;\">Change mentors</a>";
                echo "<a href=\"#popup3\" class=\"button1\" style=\"text-decoration:none; margin-right:10px;\">Group Students</a>";
                echo "<a href=\"export.php?id=$classData->classId\" class=\"button1\" style=\"text-decoration:none; margin-right:10px;\">Export Students</a>";
                echo "<a href=\"#popup0\" class=\"button1\" onclick=\"shareClass($classData->classId)\" style=\"text-decoration:none; margin-right:10px;\">Invite Students</a>";
              }
        ?></br></br>
        <div class="clearfix1">
          <a href="#popup8" style="text-decoration:none;">
            <div class="basiccontainer">
              <div class="container_color">
                <p class="subject">Subject</p>
                <span class="time" >11:00</span>
                <p class="An_content"> Contenti sdfahsgdfjasgfdasf</p>
              </div>
            </div>
          </a>
        </div>
      </div>
      <!-- Q&A -->
      <div class="content" id="Q&A">
        <?php if($app->user->type() == 'student')
        {
          echo "<a href=\"#popup5\" class=\"button1\" style=\"float:left; text-decoration:none; margin-left:40px;\">Ask</a><br /><br />";
        }
        ?>
        <div class="clearfix2">
        <?php if($app->user->type() == 'teacher')
        {
          echo "<a href=\"#popup9\" style=\"text-decoration:none;\">";
        }
        ?>
          <div class="basiccontainer">
            <div class="container_color">
              <p class="identification">Emri dhe Mbiemri</p>
              <img src="\static\img\avatar.png" width="56.25px" height="56.25px" alt="photo" align="right" />
              <p class="questions">Pyetje  </p>
              <span class="time" >11:00</span>
              <p class="answers"> Pergjigjje dsdfdsfsdfd edhvedhvefhvewfvedvekdve ef ef rf  f rf rf fefsef sfrgfrwgwrf</p>
            </div>
          </div>
          <?php if($app->user->type() == 'teacher')
          {
            echo "</a>";
          }
          ?>
        </div>
      </div>
      <!-- Resources -->
      <div class="content" id="Resources">
        <?php if($app->user->type() == 'teacher')
              {
                echo "<a href=\"#popup4\" class=\"button1\" style=\"float:left; text-decoration:none; margin-left:40px;\">Add resources</a>";
              }
        ?></br></br>
        <div class="clearfix2">
          <p><b>Lecture Material</b></p>
          <!-- -->
          </br>
          <p><b>Exercises</b></p>
          <!-- -->
          </br>
          <p><b>Web Resouces</b></p>
          <!-- -->
          </br>
          <p><b>Homework</b></p>
          <!-- -->
          </br>
        </div>
      </div>
      <!-- StudentData -->
      <?php if($app->user->type() == 'teacher')
      {
        echo "<div class=\"content\" id=\"StudentData\">";
        echo "<a href=\"#popup6\" class=\"button1\" style=\"float:left; text-decoration:none; margin-left:40px;\">Attendance</a>";
        echo "<a href=\"#popup7\" class=\"button1\" style=\"float:left; text-decoration:none; margin-left:40px;\">Project Evaluation</a>";
        echo "<button class=\"button1\">Export Data</button>";
        echo "</div>";
      }?>
    </div>
</div>
<!-- Invite Students -->
<div class="popup" id="popup0">
  <div class="popup_inner">
    <div class="popup_text">
      <form action="/invite.php" method="post" enctype="multipart/form-data">
        <label for="invite">Invite Link</label></br>
        <input type="text" name="invite" id="inviteLink" value="">
        </br></br>
        <input type="file" name="file" accept=".csv">
        <input type="submit" value="Invite">
      </form>
    </div>
    <a href="#ClassInfo" class="popup_close">X</a>
  </div>
</div>
<!-- Change Mentors -->
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
    <a href="#ClassInfo" class="popup_close">X</a>
  </div>
</div>
<!-- Add an announcement -->
<div class="popup" id="popup2">
  <div class="popup_inner">
    <div class="popup_text">
      <form action="#" method="post">
        <label for="subject">Subject</label>
        <input type="text" id="subject" name="subject" placeholder="Subject.." value="" required>
        <label for="contentA">Content</label>
        <textarea rows="4" cols="50" id="contentA" name="contentA" placeholder="Content.." value=""></textarea>
        <input list="section" name="hashtag" placeholder="Hashtag.." value="">
        <datalist id="section">
          <option value="Lectures">
          <option value="Lab">
          <option value="Projects">
          <option value="Results">
        </datalist>
        </br> </br>
        <label for="attachment">PDF Attachment</label></br>
        <input type="file" id="attachment" name="attachment" accept=".pdf" value="" multiple></br>
        <label for="picture">Picture</label></br>
        <input type="file" id="picture" name="picture" accept="image/*" value="" multiple>
        </br>
        <input type="submit" value="Publish">
      </form>
      <a href="#ClassInfo" class="popup_close">X</a>
    </div>
  </div>
</div>
<!-- Group Students -->
<div class="popup" id="popup3">
  <div class="popup_inner">
    <div class="popup_text">
      <form action="#" mathod="post">

        <input type="submit" value="Group">
      </form>
    </div>
    <a href="#ClassInfo" class="popup_close">X</a>
  </div>
</div>
<!-- Add Resources -->
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
      <a href="#Resouces" class="popup_close">X</a>
    </div>
  </div>
</div>
<!-- Ask a question -->
<div class="popup" id="popup5">
  <div class="popup_inner">
    <div class="popup_text">
      <form action="#" method="post">
        <label for="question_subject">Add a subject here...</label>
        <input type="text" id="question_subject" name="question_subject" placeholder="Subject.." value="" required>
        <label for="questsion_content">Type your question here...</label>
        <textarea rows="4" cols="50" id="questsion_content" name="question_content" placeholder="Ask a question.." value=""></textarea><br />
        <input type="submit" value="Ask">
      </form>
      <a href="#Q&A" class="popup_close">X</a>
    </div>
  </div>
</div>
<!-- Attendance -->
<div class="popup" id="popup6">
  <div class="popup_inner">
    <div class="popup_text">
      <div class="clearfix3">
        <form action="" method="post">
          <table>
            <thead>
              <tr>
                <td>StudentId</td>
                <td>Name</td>
                <td>Attendance</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>
          <input type="submit" value="Add Data">
       </form>
      </div>
      <a href="#SudentData" class="popup_close">X</a>
    </div>
  </div>
</div>
<!-- Project Evaluation -->
<div class="popup" id="popup7">
  <div class="popup_inner">
    <div class="popup_text">
      <form action="" method="post">
      </form>
      <a href="#StudentData" class="popup_close">X</a>
    </div>
  </div>
</div>
<div class="popup" id="popup8">
  <div class="popup_inner">
    <div class="popup_text">
      <p class="subject">Subject</p>
      <span class="time" >11:00</span>
      <p class="An_content"> Contenti sdfahsgdfjasgfdasf</p>
      <!-- image and Attachment-->
      <a href="#StudentData" class="popup_close">X</a>
    </div>
  </div>
</div>
<div class="popup" id="popup9">
  <div class="popup_inner">
    <div class="popup_text">
      <form action="#" method="post">
        <label for="Answer">Answer</label>
        <input type="text" id="answer" name="answer" placeholder="Answer.." value="">
        <input type="submit" value="Answer">
      </form>
      <a href="#StudentData" class="popup_close">X</a>
    </div>
  </div>
</div
