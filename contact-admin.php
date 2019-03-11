<?php
    session_start();
    require("common/common.php");
    session_unset();
    if(session_destroy())
    {

    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Contact Admin</title>
        <meta name="author" content="Pankajsree Das">
        <?= $head ?>
        <link rel="stylesheet" href="assets/css/submit.css" />
    </head>
    <body>
        <header>
            <div id="header-top" class="container-fluid">
                <img class="d-inline-block" src="<?= __ROOT__ ?>/images/logo/header.png" alt="">
        </header>
        <div class="message">
            Contact the exam Invigilator !!!
        </div>
        <?= $footer ?>
    </body>
</html>
