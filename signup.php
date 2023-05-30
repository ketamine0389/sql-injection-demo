<?php
    session_start();
    if (isset($_SESSION["loggedin"])) {
        header("Location: posts.php");
        die("logged in");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    </head>
    <form method="POST">
        <label for="user">Username:</label>
        <input id="frmUser" name="user" type="text" min="4" max="32" required>
        <label for="pass">Password:</label>
        <input id="frmPass" name="pass" type="text" min="8" max="128" required>
        <button type="submit">Log in</button>
    </form>
    <a href="login.php">Already a user?</a>
    <script>
        $('frm').on('submit', function (e) {
            e.preventDefault();
        
            $('form > button').prop('disabled', true);
        
            $.ajax({
                type: "POST",
                url: "resources/createuser.php",
                data: new FormData(this),
                success: function (res) {
                    location.href('posts.php');
                },
            }).fail(data => {
                alert('Not a user (probably)');
                $('form > button').prop('disabled', true);
            });
        });
    
    </script>
</html>