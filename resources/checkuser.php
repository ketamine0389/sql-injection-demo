<?php
    include('pdo.php');

    session_start();

    if (!isset($_POST['user']) || !isset($_POST['pass']))
        goto broke;

    $user = $_POST['user'];
    $pass = $_POST['pass'];
    
    $query = "SELECT users.*, passwords.STR AS password_str FROM users JOIN passwords ON users.P_ID = passwords.ID WHERE users.NAME = \"$user\"";
    $stmt = $db -> prepare($query);
    $stmt -> execute();
    $mhm = $stmt -> fetch();

    if ($mhm) {
        if ($pass === $mhm['password_str']) {
            $_SESSION['loggedin'] = true;
    		echo "success";
        } else {
            echo "error";
        }
	} else {
        broke:
	    echo "error";
	}

    $db = null;
?>