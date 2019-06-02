<?php view('layout/main_header', [
    'title' => 'StuDB',
    'css' => '/static/css/class.css',
    'javascript' => '/static/js/class.js',
    'javascript2' => 'https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js'
]);?>
<div class='error'><?= fallback($message, null) ?></div>
<div style="padding-left:5%; padding-right:5%; padding-top:15px;">
  <?php
  view('layout/class_menu');
  $classData = fallback($classData, null);
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
            <?php
              $assistants = $app->classes->getAssistants($classData->classId);
              if($assistants) {
                echo "<p><b>Assistant Professor(s):";
                foreach ($assistants as $a) {
                  echo $a->name . '|';
                }
                echo "</b></p>";
              }
            ?>
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
        ?><br/><br/>
      <?php
        $announcements = $app->classes->getAnnouncements($classData->classId);
        if($announcements) {
          echo '<div class="clearfix1">';
          foreach($announcements as $a) {
            echo '<a href="#popup8" style="text-decoration:none;">
                      <div class="basiccontainer">
                        <div class="container_color">
                          <p class="subject">[' . $a->tag . '] ' . $a->title . '-' . $a->name . '</p>
                    <span class="time">' . $a->time . '</span>
                    <p class="An_content">' . $a->content .'</p>
                  </div>
                </div>
              </a>';
          }
          echo '</div>';
        }
      ?>
      </div>
      <!-- Q&A -->
      <div class="content" id="Q&A">
        <?php if($app->user->type() == 'student')
        {
          echo "<a href=\"#popup5\" class=\"button1\" style=\"float:left; text-decoration:none; margin-left:40px;\">Ask</a><br /><br />";
        }
        ?>
        <?php
          $questions = $app->classes->getQuestions($classData->classId);
          if($questions)
          {
            echo '<div class="clearfix2">';
            foreach($questions as $q)
            {
                echo "<a href=\"#popup9\" style=\"text-decoration:none;\">";
                echo "
                    <div class=\"basiccontainer\">
                      <div class=\"container_color\">
                        <p class=\"identification\">". $q->name . "</p>
                        <img src=\"\static\img\avatar.png\" width=\"56.25px\" height=\"56.25px\" alt=\"photo\" align=\"right\" />
                        <p class=\"questions\">". $q->title . "</p>
                        <span class=\"time\" >" . $q->time . "</span>
                        <p class=\"answers\">". $q->content ."</p>
                      </div>
                    </div>";
                echo "</a>";
            }
            echo "</div>";
          }
        ?>
      </div>
      <!-- Resources -->
      <div class="content" id="Resources">
        <?php if($app->user->type() == 'teacher')
              {
                echo "<a href=\"#popup4\" class=\"button1\" style=\"float:left; text-decoration:none; margin-left:40px;\">Add resources</a>";
              }
        ?><br/><br/>
        <div class="clearfix2">
          <p class="pr"><b>Lecture Material</b></p>
          <div class="classinfo">
            <?php
              foreach($app->db->query('SELECT name, filepath FROM resources WHERE section="Lectures"') as $row) {
                echo "<a href='/download_attachment.php?file=" . $row->filepath . "'><p>" . $row->name . "</p></a>";
              }
            ?>
          </div>
          <p class="pr"><b>Lab</b></p>
          <div class="classinfo">
            <?php
              foreach($app->db->query('SELECT name, filepath FROM resources WHERE section="Lab"') as $row) {
                echo "<a href='/download_attachment.php?file=" . $row->filepath . "'><p>" . $row->name . "</p></a>";
              }
            ?>
          </div>
          <p class="pr"><b>Projects</b></p>
          <div class="classinfo">
            <?php
              foreach($app->db->query('SELECT name, filepath FROM resources WHERE section="Projects"') as $row) {
                echo "<a href='/download_attachment.php?file=" . $row->filepath . "'><p>" . $row->name . "</p></a>";
              }
            ?>
          </div>
          <p class="pr"><b>Results</b></p>
          <div class="classinfo">
            <?php
              foreach($app->db->query('SELECT name, filepath FROM resources WHERE section="Results"') as $row) {
                echo "<a href='/download_attachment.php?file=" . $row->filepath . "'><p>" . $row->name . "</p></a>";
              }
            ?>
          </div>
          <p class="pr"><b>Homework</b></p>
          <div class="classinfo">
            <?php
              foreach($app->db->query('SELECT name, filepath FROM resources WHERE section="Homework"') as $row) {
                echo "<a href='/download_attachment.php?file=" . $row->filepath . "'><p>" . $row->name . "</p></a>";
              }
            ?>
          </div>
        </div>
      </div>
      <!-- StudentData -->
      <?php if($app->user->type() == 'teacher')
      {
        echo "<div class=\"content\" id=\"StudentData\">";
        echo "<a href=\"#popup6\" class=\"button1\" style=\"float:left; text-decoration:none; margin-left:40px;\">Attendance</a>";
        echo "<a href=\"#popup7\" class=\"button1\" style=\"float:left; text-decoration:none; margin-left:40px;\">Project Evaluation</a>";
        echo "</div>";
      }?>
    </div>
</div>
<!-- Invite Students -->
<div class="popup" id="popup0">
  <div class="popup_inner">
    <div class="popup_text">
      <form action="/invite.php" method="post" enctype="multipart/form-data">
        <label for="invite">Invite Link</label><br/>
        <input type="text" name="invite" id="inviteLink" value="">
        <br/><br/>
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
      <form action="/add_teacher.php" method="post">
        <label for="assistant">Assistant Professor</label>
        <input type="text" id="assistant" name="assistant" placeholder="Search here">
        <input name="classId" type="hidden" value="<?= $classData->classId ?>" />
        <div id="display"></div>
        <input type="submit" value="Add">
      </form>
    </div>
    <a href="#ClassInfo" class="popup_close">X</a>
  </div>
</div>
<!-- Add an announcement -->
<div class="popup" id="popup2">
  <div class="popup_inner">
    <div class="popup_text">
      <form action="/make_announcement.php" method="post" enctype="multipart/form-data">
        <label for="title">Subject</label>
        <input type="text" id="title" name="title" placeholder="Subject" required>
        <label for="content">Content</label>
        <textarea rows="4" cols="50" id="content" name="content" placeholder="Content" ></textarea>
        <input list="section" name="tag" placeholder="Tag">
        <datalist id="section">
          <option value="Lectures">
          <option value="Lab">
          <option value="Projects">
          <option value="Results">
        </datalist>
        <br/> <br/>
        <label for="attachment">PDF Attachment</label><br/>
        <input type="file" id="attachment" name="attachment" accept=".pdf" value="" multiple><br/>
        <input name="classId" type="hidden" value="<?= $classData->classId ?>" />
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
    <?php
      $students = $app->classes->getStudents($classData->classId);
      echo "<form action='group_students.php' method='post'><table>";
      foreach ($students as $s) {
        echo "<tr><td>" . $s->name . "</td><td><input type='text' name='group' value='" . $s->group . "'/></td></tr>";
      }
        echo "</table><input type='submit' value='Submit'></form>";
    ?>
    </div>
    <a href="#ClassInfo" class="popup_close">X</a>
  </div>
</div>
<!-- Add Resources -->
<div class="popup" id="popup4">
  <div class="popup_inner">
    <div class="popup_text">
      <form action="/resources.php" method="post" enctype="multipart/form-data">
        <label for="section">Section</label>
        <input list="section2" name="section" placeholder="Section">
        <datalist id="section2">
          <option value="Lecture material">
          <option value="Lab">
          <option value="Project">
          <option value="Results">
          <option value="Homework">
        </datalist>
        <br/> <br/>
        <label for="attachment">Attachment</label><br/>
        <input type="file" id="attachment" name="attachment" accept=".pdf" ><br/>
        <input name="classId" type="hidden" value="<?= $classData->classId ?>" />
        <input type="submit" value="Add resources">
      </form>
      <a href="#Resources" class="popup_close">X</a>
    </div>
  </div>
</div>
<!-- Ask a question -->
<div class="popup" id="popup5">
  <div class="popup_inner">
    <div class="popup_text">
      <form action="/make_question.php" method="post">
        <label for="title">Add a subject here</label>
        <input type="text" id="title" name="title" placeholder="Subject" required>
        <label for="content">Type your question here</label>
        <textarea rows="4" cols="50" id="content" name="content" placeholder="Ask a question"></textarea><br />
        <input name="classId" type="hidden" value="<?= $classData->classId ?>" />
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
      <?php
      echo "<p>". $q->name . "</p>
            <p>". $q->title . "</p>
            <span>" . $q->time . "</span>
            <p>". $q->content ."</p>";
      ?>
      <?php
          $answers = $app->classes->getAnswerss($classData->classId);
          if($answers) {
            echo '<div class="clearfix1">';
            foreach($answers as $an) {
              echo '<div class="basiccontainer">
                      <div class="container_color">
                        <p class="subject">[' . $an->tag . '] ' . $an->title . '</p>
                        <span class="time">' . $an->time . '</span>
                        <p class="An_content">' . $an->content .'</p>
                     </div>
                   </div>';
            }
            echo '</div>';
          }
      ?>
      <?php
      if($app->user->type() == 'teacher')
      {
      echo '
            <form action="#" method="post">
              <label for="Answer">Answer</label>
              <input type="text" id="answer" name="answer" placeholder="Answer.." value="">
              <input type="submit" value="Answer">
              <input name="authorId" type="hidden" value="<?= $classData->authorId ?>" />
              <input name="questionId" type="hidden" value="<?= $classData->questionId ?>" />
              <input name="classId" type="hidden" value="<?= $classData->classId ?>" />
            </form>';
      }
      ?>
      <a href="#StudentData" class="popup_close">X</a>
    </div>
  </div>
</div>
