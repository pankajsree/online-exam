<?php
    require("common/common.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Online Examination Application</title>
        <?= $head ?>
        <link rel='stylesheet' href='assets/css/home.css' />
    </head>
    <style media="screen">
        body {
            padding-top: 0;
        }
        main {
            padding-top: 5rem;
        }
    </style>
    <body>
        <header>
            <div id="header-top" class="container-fluid">
                <img class="d-inline-block" src="<?= __ROOT__ ?>/images/logo/header.png" alt="">
        </header>
        <main>
            <div class="btn-container">
                <a href="admin-login">Admin Login</a>
                <a href="login">User Login</a>
            </div>
        </main>

        <?= $footer ?>
    </body>
</html>
