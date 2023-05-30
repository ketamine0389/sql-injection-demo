<?php
    session_start();

    if (!isset($_SESSION["loggedin"])) {
        header("Location: index.php");
        die("not logged in");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    </head>
    <body>
        <a class="btn btn-primary" href="logout.php">Log Out</a>
        <div id="here">

        </div>
        <script>
            $(function () {     
                $.ajax({
                    type: "GET",
                    url: "resources/getposts.php",
                    dataType: "json",
                    success: function (res) {
                        res.forEach((e, i) => {
                            $('#here').append(
                                `<div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">User: ${e.USER_NAME}</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">Time Posted: ${e.POST_TOC}</h6>
                                        <p class="card-text">${e.STR}</p>
                                    </div>
                                </div>`
                            );
                        });
                    },
                }).fail(data => {
                    alert('fatal error');
                });
            });
        </script>
    </body>
</html>
