<?= view('layout/main_header', [
  'css' => '/static/css/profile.css',
  'title' => $app->user->name() . "'s profile"
]) ?>

<body>
  <div class="resume-wrapper">
  <article style="margin-top:30px;" class="paper">
<header>
        <div class="header-content">
          <div class="header-pic" title="picture">
            <div class="pic"></div>
          </div>
          <div class="header-text">
            <table cellspacing ="10">
              <tr>
                <td style="font-size:15px; font-style:italic;">Niveli i arsimimit</td>
                <td style="font-weight:bold;"><?= $app->user->name() ?></td>
            </tr>
            </table>
          </div>
        </div>
      </header>

        <button class="button-edit" onclick="editForm()">Edit Profile</button>
        <div class="edit-form" id="myForm">
          <form class="form-container">
            <h1>Edit Profile</h1>
            <br>

            <label for="email"><b>Name</b></label><br>
            <input type="text" placeholder="Enter First Name" name="firstname">
            <input type="text" placeholder="Enter Last Name" name="lastname"><br>

            <label for="psw"><b>Password</b></label><br>
            <input type="password" placeholder="Enter Password" name="psw">
              <input type="password" placeholder="Confirm Password" ><br>

            <label for="email"><b>Email Address</b></label><br>
            <input type="text" placeholder="Enter Email Address" name="email">
            <input type="text" placeholder="Enter Email Address" ><br>

            <label for="email"><b>Avatar</b></label><br>
            <input type="file" name="avatar"><br><br>

            <label for="email"><b>Title</b></label><br>
            <input type="text" placeholder="Enter Title" name="title"><br>

            <label for="email"><b>Phone Number</b></label><br>
            <input type="text" placeholder="Enter Phone Number" name="phone"><br>

            <label for="email"><b>Website</b></label><br>
            <input type="text" placeholder="Enter Website" name="website"><br>

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
                <li><?= $app->user->website() ?></li>
              </ul>
              <ul>
                <li>Email</li>
                <li><?= $app->user->email() ?></li>
              </ul>
              <ul>
                <li>Phone</li>
                <li><?= $app->user->phone() ?></li>
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
