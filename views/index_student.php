<!-- </main_header> -->
<?php view('layout/main_header', [
    'title' => 'StuDB',
    'css' => '/static/css/index.css'
]);?>
<div id="header-featured" style="background-image: url('/static/img/pano_student.jpg')">
    <h1>Welcome STUDENT <?= $app->user->name() ?></h1>
</div>
<div id="banner-wrapper">
    <div id="banner" class="container">
        <p><b>StuDB Platform</b></br>It is the most amazing and incredible platform that enables easy communication inside the academic framework.
        </br>Every professor will have the opportunity of mentoring students online, while students will have easier access to academic services offered by the university.</p>
    </div>
</div>
<div id="wrapper">
    <div id="extra" class="container">
        <h2>We provide you the best online education system.</h2>
        <span>Better connections for a better education.</span>
        <br>
        <a href="classes.php" class="button">Go to Classes</a>
    </div>
</div>
<?php view('layout/main_footer')?>
<!-- </main_footer> -->
