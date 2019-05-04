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
        <div class="container" id="container">
            <div class="form-container sign-up-container">
                <form action="/signup.php" method="POST" id="signup">
                    <h1>Create Account</h1>
                    <input type="text" placeholder="Full name"/>
                    <input type="email" placeholder="Email"/>
                    <input type="password" placeholder="Password"/>
                    <input type="password" placeholder="Confirm Password"/>
                    <span style="font-size: 20px">I am a:</span>
                    <input type="radio" name="type" value="Teacher">Teacher
                    <input type="radio" name="type" value="Student">Student
                    <button type="submit" form="signup" value="Submit">Sign Up</button>
                </form>
            </div>
            <div class="form-container sign-in-container">
                <form action="../php/signin.php" method="POST" id="signin">
                    <h1>Sign in</h1>
                    <input type="email" placeholder="Email" />
                    <input type="password" placeholder="Password" />
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

        <script src="../js/login.js"></script>
    </body>
</html>