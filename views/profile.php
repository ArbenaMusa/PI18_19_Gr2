<?= view('layout/main_header', [
  'css' => '/static/css/profile.css',
  'title' => $user->name . "'s profile"
]) ?>

<body>
  <div class="resume-wrapper">
  <article style="margin-top:30px;" class="paper">
<header>
        <div class="header-content">
        <div class="error"><?= fallback($message, null) ?></div>
        <?php if (fallback($success, false)) { echo '<div class="success">Information updated successfully</div>'; } ?>
          <div class="header-pic" title="picture">
            <div class="pic"></div>
          </div>
          <div class="header-text">
            <table cellspacing ="10">
              <tr>
                <td style="font-size:15px; font-style:italic;"><?= fallback($user->title, "") ?></td>
                <td style="font-weight:bold;"><?= $user->name ?></td>
              </tr>
            </table>
          </div>
        </div>
      </header>

        <button class="button1" onclick="editForm()">Edit Profile</button>
        <div class="edit-form" id="myForm">
          <form class="form-container" action="/profile.php" method="post" enctype="multipart/form-data">
            <h1>Edit Profile</h1>
            <br>

            <label for="name"><b>Name</b></label><br>
            <input type="text" placeholder="Enter Name" name="name" value="<?= $user->name ?>"><br>

            <label for="avatar"><b>Avatar</b></label><br>
            <input type="file" name="avatar" accept="image/*"><br><br>

            <label for="title"><b>Title</b></label><br>
            <input type="text" placeholder="Enter Title" name="title" value="<?= $user->title ?>"><br>

            <label for="phone"><b>Phone Number</b></label><br>
            <input type="text" placeholder="Enter Phone Number" name="phone" value="<?= $user->phone ?>" ><br>

            <label for="website"><b>Website</b></label><br>
            <input type="text" placeholder="Enter Website" name="website" value="<?= $user->website ?>" ><br>

            <button type="submit" class="btn save">Save Profile</button>
            <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
          </form>
        </div>
        
        <script>
        function editForm() {
          document.getElementById("myForm").style.display = "block";
        }

        function closeForm() {
          document.getElementById("myForm").style.display = "none";
        }
        </script>

      <div class="content-wrapper">
        <section class="content">
          <div class="row">
            <div class="content-cat">
             Contact
            </div>
            <div class="content-text">
              <ul>
                <li>Website</li>
                <a href="<?= $user->website ?>"><li><?= $user->website ?></li></a>
              </ul>
              <ul>
                <li>Email</li>
                <li><?= $user->email ?></li>
              </ul>
              <ul>
                <li>Phone</li>
                <li><?= $user->phone ?></li>
              </ul>
            </div>
          </div>
        </section>
        <section class="content">
          <div class="row">
            <div class="content-cat">
             Profiles
            </div>
            <div class="content-text">
              <ul>
                <li>Twitter</li>
                <li>
                  <a href="#" target="_blank">twitter</a>
                </li>
              </ul>
              <ul>
                <li>Facebook</li>
                <li>
                  <a href="#" target="_blank">facebook</a>
                </li>
              </ul>
              <ul>
                <li>LinkedIn</li>
                <li>
                  <a href="#" target="_blank">LinkedIn</a>
                </li>
              </ul>
            </div>
            </div>
        </section>

      </div>
    </article>
  </div>
</body>
</html>
