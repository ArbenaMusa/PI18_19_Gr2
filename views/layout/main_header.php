<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, intial-scale=1.0"/>
    <title><?= fallback($title, "StuDB") ?></title>
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
    <link rel="stylesheet" href="<?= $css ?>"/>
  </head>
  <body>
    <div id="header-wrapper">
      <div id="header" class="container">
        <div id="logo">
          <a href="/index.php"><h1>StuDB</h1>
          <img src="/static/img/StuDB.png" width="55" height="55"></a>
        </div>
        <div id="menu">
          <ul>
            <li class="current_page_item"><a href="#" title="">Menu 1</a></li>
            <li><a href="#" title="">Menu 2</a></li>
            <li><a href="#" title="">Menu 3</a></li>
            <li><a href="#" title="">Menu 3</a></li>
            <li><a href="#" title="">Menu 4</a></li>
            <li>
              <div class="dropdown">
                <img src="/static/img/avatar.png" alt="Avatar" width="50" height="50" style="border: #FF4B2B solid 2px;">
                <div class="dropdown-content">
                  <img src="/static/img/avatar.png" alt="Avatar" width="200" height="200" style="border: #FF4B2B solid 2px;">
                  <div class="personal"><?= $app->user->name() ?></div>
                    <a href="/profile.php">Profile</a>
                    <a href="/logout.php"><button class="button1">Sign out</button></a></div>
                  </div>
                </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  <!-- <View> -->
