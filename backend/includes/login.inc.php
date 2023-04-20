<?php

if (isset($_POST['submit'])) {
    echo "test";
    // Grabbing data
    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];

    // Instantiate SignupContr class
    include '../classes/dbh.classes.php';
    include '../classes/login.classes.php';
    include '../classes/login-contr.classes.php';
    $signup = new LoginContr($uid, $pwd);

    // Running error handlers and user handlers
    $signup->loginUser();

    // Going back to front page
    header("location: ../index.php?error=none");
}else{
    echo "error";
}