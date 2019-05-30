<div class="vertical-menu">
  <a href="#" class="active">Class1</a>
  <?php if($app->user->type() == 'teacher')
        {
          echo "<a href=\"class.php\#popup\" class=\"active\">Create a class</a>";
        }
  ?>
</div>
