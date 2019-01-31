<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Logout</title>
    </head>
    <body>
    <?php
        session_start();
        session_unset();
        if(session_destroy())
        {
            header("Location: login");
        }
    ?>
    </body>
</html>
