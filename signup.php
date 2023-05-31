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
            <input id="frmUser" name="user" type="text" min="4" max="32" required>
            <label for="pass">Password:</label>
            <input id="frmPass" name="pass" type="password" min="8" max="128" required>
            <button type="submit">Sign up</button>
        </form>
        <a href="login.php">Already a user?</a>
        <script>
            $('form').on('submit', function (e) {
                e.preventDefault();
            
                $('form > button').prop('disabled', true);
            
                $.ajax({
                    type: "POST",
                    url: "resources/createuser.php",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        if (res == 'success') return location.href = 'posts.php';
                            alert('Not a user (probably)');
                            $('form > button').prop('disabled', false);
                        
                    },
                }).fail(data => {
                    alert('Not a user (probably)');
                    $('form > button').prop('disabled', false);
                });
            });
        
        </script>
    </body>
</html>