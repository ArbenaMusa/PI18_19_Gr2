<!-- </main_header> -->
<?php view('layout/main_header', [
    'title' => 'StuDB',
    'css' => '/static/css/index.css'
]);?>
<div id="header-featured" style="background-image: url('/static/img/pano_teacher.jpg')">
    <h1>Welcome TEACHER <?= $app->user->name() ?></h1>
</div>
<div id="banner-wrapper">
    <div id="banner" class="container">
        <p><b>Platforma StuDB</b></br>Eshte nje nder platformat me te jashtezakonshme qe mundeson komunikim me te lehte brenda suazave akademike.
        </br>Cdo profesore do te kete mundesi me te persosur te mentorimit te studenteve, ndersa studentet do te kene qasje me te lehte ne sherbimet akademike te ofruara nga universiteti.</p>
    </div>
</div>
<div id="wrapper">
    <div id="extra" class="container">
        <h2>Nifar lloj gjeje tjeter ktu.</h2>
        <span>Nifar lloj pershkrimi i ksaj gjese tjeter ktu.</span>
        <a href="classes.php" class="button">nifar butoni</a>
    </div>
</div>
<?php view('layout/main_footer')?>
<!-- </main_footer> -->
