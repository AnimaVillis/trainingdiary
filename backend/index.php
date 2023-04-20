<?php

date_default_timezone_set('America/Los_Angeles');

require("/var/www/html/vendor/autoload.php");

$fw = \Base::instance();

// For everything else, rely on routes specified in config.
$fw->config("/var/www/html/config.ini");

$fw->set("ONREROUTE", function($route){
    return $route . '/';
});

// For all page requests that are not API requests, we want to load the compiled frontend
$fw->route(["GET /", "GET /*"], function(\Base $fw) {
    if (strpos($fw->PATH, "/api/") === 0) {
        $fw->error(404);
    }
    echo file_get_contents("/var/www/html/dist/index.html");
});

$fw->run();
?> 

<?php 
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <section class="index-login">
        <div class="wrapper">
            <div class="index-login-signup">
                <h4>SIGN UP</h4>
                <p>Don't have an account yet? Sign up here!</p>
                <form action="includes/signup.inc.php" method="post">
                    <input type="text" name="uid" placeholder="Username">
                    <input type="password" name="pwd" placeholder="Password">
                    <input type="password" name="pwdrepeat" placeholder="Repeat Password">
                    <input type="email" name="email" placeholder="E-mail">
                    <br>
                    <button type="submit" name="submit">SIGN UP</button>
                </form>
            </div>
            <div class="index-login-login">
                <h4>LOGIN</h4>
                <p>Have an account? Sign in here!</p>
                <form action="includes/login.inc.php" method="post">
                    <input type="text" name="uid" placeholder="Username">
                    <input type="password" name="pwd" placeholder="Password">
                    <br>
                    <button type="submit" name="submit">LOGIN</button>
                </form>
                <a href="./includes/logout.inc.php">Logout</a>
            </div>
        </div>
    </section>
</body>

</html>