<?php
    include('pdo.php');
    $arr = [];
    $query = "SELECT posts.id as POST_ID, posts.U_ID AS USER_ID, users.name AS USER_NAME, posts.STR, posts.TOC AS POST_TOC, users.TOC AS USER_TOC FROM posts JOIN users ON posts.U_ID = users.id;";

    $stmt = $db -> prepare($query);

    if ($stmt -> execute()) {
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$arr[] = $row;
		}

		header('Content-Type: application/json');
		echo json_encode($arr);
	} else {
	    echo "error";
	}

    $db = null;
?>