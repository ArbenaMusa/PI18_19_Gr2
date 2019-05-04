<?php view('layout/main_header') ?>

<form method="post" action="/login.php">
  <?php
    if (!$modelState->isValid()) {
      echo 'Keni gabime!<br />';
      echo '<ul class="error-list">';
      foreach ($modelState->errors() as $error) {
        echo '<li class="error-item">' . $error . '</li>';
      }
      echo '</ul>';
    }
  ?>
  <input type="text" name="username" value="<?= $model->username ?>" />
  <br />
  <input type="text" name="email" value="<?= $model->email ?>" />
  <br />
  <input type="text" name="mosha" value="<?= $model->mosha ?>" />
  <br />
  <input type="submit" />
</form>

<?php view('layout/main_footer') ?>
