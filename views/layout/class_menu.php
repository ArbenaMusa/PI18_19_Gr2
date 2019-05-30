<div class="vertical-menu">
  <?php if($app->user->type() == 'teacher')
        {
          echo "<a href=\"#popup\" class=\"active\">Create a class</a>";
          echo "<a href=\"#popup0\" class=\"active\">Invite Students</a>";
          echo "<a href=\"#popup3\" class=\"active\">Group Students</a>";
        }
  ?>
  <a href="#" class="active">Class1</a>
</div>
