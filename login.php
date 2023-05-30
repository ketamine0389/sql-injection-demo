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
    <body>
        <form method="POST">
            <label for="user">Username:</label>
            <input id="frmUser" name="user" type="text">
            <label for="pass">Password:</label>
            <input id="frmPass" name="pass" type="text">
            <button type="submit">Log in</button>
        </form>
        <a href="signup.php">Not a user?</a>
        <script>
            $('frm').on('submit', e => {
                e.preventDefault();
            
                $('form > button').prop('disabled', true);
            
                $.ajax({
                    type: "POST",
                    url: "resources/checkuser.php",
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
    </body>
</html>