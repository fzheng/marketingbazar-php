<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8" />
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
    <title>Marketingbazar: our slogan, our service, our future</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
    <link rel="stylesheet" href="./www/css/loginMain.css" type="text/css"/>
    <link rel="stylesheet" href="./www/css/loginStyle.css" type="text/css"/>
    <link rel="stylesheet" href="./www/css/animate-custom.css" type="text/css"/>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src="./www/js/signup.js"></script>
</head>
<body>
<div class="container">
    <header>
        <h2>Welcome <?echo $name?>, is this your first time to use this <? echo $provider ?> account?</h2>
        <h2>Please login or signup your marketingbazar account to connect your <? echo $provider ?> account</h2>
    </header>
    <section>
        <div id="container_demo" >
            <a class="hiddenanchor" id="toregister"></a>
            <a class="hiddenanchor" id="tologin"></a>
            <div id="wrapper">
                <div id="login" class="animate form">
                    <form action="main/login" id="loginForm" method="post" autocomplete="on">
                        <h1>Log in</h1>
                        <p>
                            <label for="username" class="uname"> Your email or username </label>
                            <input id="username" name="username" required="required" type="text" placeholder="John123 or john@mail.com"/>
                        </p>
                        <p>
                            <label for="password" class="youpasswd"> Your password </label>
                            <input id="password" name="password" required="required" type="password" placeholder="P@ssw0rd" />
                        </p>
                        <p class="keeplogin">
                            <input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" />
                            <label for="loginkeeping">Keep me logged in</label>
                        </p>
                        <p class="login button">
                            <input type="submit" value="Login" />
                        </p>
                        <p class="change_link">
                            Not a member yet ?
                            <a href="#toregister" class="to_register">Click to join Marketingbazar</a>
                        </p>
                    </form>
                </div>

                <div id="register" class="animate form">
                    <form action="main/register" id="registerForm" method="post" autocomplete="on">
                        <h1> Sign up </h1>
                        <p>
                            <label for="usernamesignup" class="uname">Your username</label>
                            <input id="usernamesignup" name="usernamesignup" required="required" type="text" placeholder="John123" />
                        </p>
                        <p>
                            <label for="emailsignup" class="youmail"> Your email</label>
                            <input id="emailsignup" name="emailsignup" required="required" type="email" placeholder="john@mail.com"/>
                        </p>
                        <p>
                            <label for="passwordsignup" class="youpasswd">Your password </label>
                            <input id="passwordsignup" name="passwordsignup" required="required" type="password" placeholder="P@ssw0rd"/>
                        </p>
                        <p>
                            <label for="passwordsignup_confirm" class="youpasswd">Please confirm your password </label>
                            <input id="passwordsignup_confirm" name="passwordsignup_confirm" required="required" type="password" placeholder="P@ssw0rd, once again"/>
                        </p>
                        <p class="signin button">
                            <input type="submit" value="Sign up"/>
                        </p>
                        <p class="change_link">
                            Already a member ?
                            <a href="#tologin" class="to_register"> Click to log in</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
</body>
</html>