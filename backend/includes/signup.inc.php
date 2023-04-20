<?php

if (isset($_POST['submit'])) {
    // Grabbing data
    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];
    $pwdRepeat = $_POST['pwdrepeat'];
    $email = $_POST['email'];

    // Instantiate SignupContr class
    include '../classes/dbh.classes.php';
    include '../classes/signup.classes.php';
    include '../classes/signup-contr.classes.php';
    $signup = new SignupContr($uid, $pwd, $pwdRepeat, $email);

    // Running error handlers and user handlers
    $signup->signupUser();

    // Going back to front page
    header("location: ../index.php?error=none");
}