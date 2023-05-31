<?php
    include('pdo.php');

    session_start();

    if (!isset($_POST['user']) || !isset($_POST['pass']))
        goto broke;

    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $query = "INSERT INTO passwords (STR) VALUES (\"$pass\")";
    $stmt = $db -> prepare($query);
    $stmt -> execute();
    $p_id = $db -> lastInsertId();

    $query = "INSERT INTO users (NAME, P_ID) VALUES (\"$user\", \"$p_id\")";
    $stmt = $db -> prepare($query);

    if ($stmt -> execute()) {
        $_SESSION['loggedin'] = true;
		echo ('success');
	} else {
        broke:
        echo "error";
	}
    
    $db = null;
?>