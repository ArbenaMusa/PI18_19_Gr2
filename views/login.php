<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, intial-scale=1.0"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <link rel="stylesheet" href="/static/css/login.css"/>
        <title>StuDB</title>
    </head>
    <body>
        <div class="container <?php if ($panel == 'register') echo 'right-panel-active' ?>" id="container">
            <div class="form-container sign-up-container">
                <form action="/register.php" method="POST" id="signup">
                    <h1>Create Account</h1>
                    <input type="text" placeholder="Full name" name="name" value="<?= fallback($model->name, '') ?>" />
                    <div class="error"><?= $model->getError('name') ?></div>
                    <input type="email" placeholder="Email" name="email" value="<?= fallback($model->email, '') ?>"/>
                    <div class="error"><?= $model->getError('email') ?></div>
                    <input type="password" placeholder="Password" name="password"/>
                    <div class="error"><?= $model->getError('password') ?></div>
                    <input type="password" placeholder="Confirm Password" name="password2"/>
                    <div class="error"><?= $model->getError('password2') ?></div>
                    <span style="font-size: 20px">I am a:</span>
                    <?php $type = fallback($model->type, 'student') ?>
                    <input type="radio" name="type" value="teacher" <?= whenEquals($type, 'teacher', 'checked') ?>>Teacher
                    <input type="radio" name="type" value="student"<?= whenEquals($type, 'student', 'checked') ?>>Student
                    <button type="submit" form="signup" value="Submit">Sign Up</button>
                </form>
            </div>
            <div class="form-container sign-in-container">
                <form action="/login.php" method="POST" id="signin">
                    <h1>Sign in</h1>
                    <div class="error"><?= $model->getError('status') ?></div>
                    <input type="email" name="email" placeholder="Email" value="<?= fallback($model->email, '') ?>"/>
                    <div class="error"><?= $model->getError('email') ?></div>
                    <input type="password" name="password" placeholder="Password" />
                    <div class="error"><?= $model->getError('password') ?></div>
                    <a href="#">Forgot your password?</a>
                    <button type="submit" form="signin" value="Submit">Sign In</button>
                </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <h1>Welcome Back!</h1>
                        <p>To keep connected with us please login with your personal info</p>
                        <button class="ghost" id="signIn">Sign In</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1>Hello, Friend!</h1>
                        <p>Enter your personal details and start journey with us</p>
                        <button class="ghost" id="signUp">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="/static/js/login.js"></script>
    </body>
</html>