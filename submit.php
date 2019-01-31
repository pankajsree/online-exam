<?php
    require("common/common.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Submit</title>
        <?= $head ?>
        <link rel="stylesheet" href="assets/css/submit.css" />
    </head>
    <body>
    <?php
        session_start();
        session_unset();
        if(session_destroy())
        {
    ?>
        <div class="message">
            Thank you for giving the Exam <i class="far fa-smile"></i>
        </div>
    <?php
        }
    ?>
    </body>
</html>
