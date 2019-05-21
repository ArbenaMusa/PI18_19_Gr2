<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, intial-scale=1.0"/>
    <title>StuDB-Front Page</title>
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
    <link rel="stylesheet" href="/static/css/index.css"/>
    <style>
      #header-featured
      {
        height: 70%;
        background-image: url(/static/img/pano_teacher.jpg);
        background-position: center;
        background-size: cover;
      }
    </style>
  </head>
  <body>
    <div id="header-wrapper">
      <div id="header" class="container">
        <div id="logo">
          <h1><a href="#"></a>StuDB</a></h1>
          <img src="/static/img/StuDB.png" width="55" height="55">
        </div>
        <div id="menu">
          <ul>
            <li class="current_page_item"><a href="#" title="">bllah</a></li>
            <li><a href="#" title="">bllah 2</a></li>
            <li><a href="#" title="">bllah 3</a></li>
            <li><a href="#" title="">bllah 3</a></li>
            <li><a href="#" title="">bllah 4</a></li>
            <li>
              <div class="dropdown">
                <img src="/static/img/avatar.png" alt="Avatar" width="50" height="50" style="border: #FF4B2B solid 2px;">
                <div class="dropdown-content">
                  <img src="/static/img/avatar.png" alt="Avatar" width="200" height="200" style="border: #FF4B2B solid 2px;">
                  <div class="personal"><?= $app->user->name() ?></div>
                    <a href="../views/profile.php">Profili</a>
                    <a href="/logout.php"><button class="button1">Sign out</button></a></div>
                  </div>
                </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  <!-- <View> -->
