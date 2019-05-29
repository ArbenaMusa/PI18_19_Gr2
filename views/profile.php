<?= view('layout/main_header', [
  'css' => '/static/css/profile.css',
  'title' => $app->user->name() . "'s profile"
]) ?>

<body>
  <div class="resume-wrapper">
  <article class="paper">
<header>
        <div class="header-content">
          <div class="header-pic" title="picture">
            <div class="pic"></div>
          </div>
          <div class="header-text">
            <p>
              <span class="first-name"><?= $app->user->name() ?></span>
            </p>
            <p class="subtitle">Niveli i arsimimit</p>
          </div>
        </div>
      </header>
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
