<?php
    session_start();
    if (!isset($_SESSION["loggedin"])) {
        echo('<a href="login.php">Log in</a><br><a href="signup.php">Sign up</a>');
    } else {
        header("Location: posts.php");
        die("logged in");
    }
?>
