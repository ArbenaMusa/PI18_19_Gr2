<!DOCTYPE html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, intial-scale=1.0"/>
        <title>StuDB-Front Page</title>
        <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
        <link rel="stylesheet" href="/static/css/index.css">
        <style>
            #header-featured
            {
                height: 70%;
                background-image: url(/static/img/pano_student.jpg);
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
                                    <a href="#">Settings</a>
                                    <a href="#">Settings</a>
                                    <a href="#">Settings</a>
                                    <a href="/logout.php"><button class="button1">Sign out</button></a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    <?php $user="arbena"?>
        <div id="header-featured">
            <h1>Welcome STUDENT <?= $app->user->name() ?></h1>
        </div>
        <div id="banner-wrapper">
            <div id="banner" class="container">
                <p>Bllah<br/> Nifar pershkrimi t'buker ktu </p>
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
        <div id="copyright" class="container">
            <p></a> | </a></p>
        </div>
    </body>
</html>