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
        <p><b>Platforma StuDB</b></br>Eshte nje nder platformat me te jashtezakonshme qe mundeson komunikim me te lehte brenda suazave akademike.
        </br>Cdo profesore do te kete mundesi me te persosur te mentorimit te studenteve, ndersa studentet do te kene qasje me te lehte ne sherbimet akademike te ofruara nga universiteti.</p>
    </div>
</div>
<div id="wrapper">
    <div id="featured-wrapper">
        <div id="featured" class="container">
            <div class="column1"> <span class="icon"></span>
                <div class="title">
                    <a href="#"><h2>Funksioni 1</h2></a>
                </div>
                <p>Nifar pershkrimi i ktij funksioni.</p>
            </div>
            <div class="column2"> <span class="icon"></span>
                <div class="title">
                    <a href="#"><h2>Funksioni 2</h2></a>
                </div>
                <p>Nifar pershkrimi i ktij funksioni.</p>
            </div>
            <div class="column3"> <span class="icon"></span>
                <div class="title">
                    <a href="#"><h2>Funksioni 3</h2></a>
                </div>
                <p>Nifar pershkrimi i ktij funksioni.</p>
            </div>
            <div class="column4"> <span class="icon"></span>
                <div class="title">
                    <a href="#"><h2>Funksioni 4</h2></a>
                </div>
                <p>Nifar pershkrimi i ktij funksioni.</p>
            </div>
        </div>
    </div>
    <div id="extra" class="container">
        <h2>Nifar lloj gjeje tjeter ktu.</h2>
        <span>Nifar lloj pershkrimi i ksaj gjese tjeter ktu.</span>
        <a href="#" class="button">nifar butoni</a>
    </div>
</div>
<div id="footer-wrapper">
    <div id="footer" class="container">
        <div class="column1">
            <div class="title">
                <a href="#"><h2>Pershkrimi 1</h2></a>
            </div>
            <p>Bllahh bllahh bllahh</p>
        </div>
        <div class="column2">
            <div class="title">
                <a href="#"><h2>Pershkrimi 2</h2></a>
            </div>
            <p>Bllahh bllahh bllahh</p>
        </div>
        <div class="column3">
            <div class="title">
                <a href="#"><h2>Pershkrimi 3</h2></a>
            </div>
            <p>Bllahh bllahh bllahh</p>
        </div>
        <div class="column4">
            <div class="title">
                <a href="#"><h2>Pershkrimi 4</h2></a>
            </div>
            <p>Bllahh bllahh bllahh</p>
        </div>
    </div>
</div>
<?php view('layout/main_footer')?>
<!-- </main_footer> -->
