<?php

    define('__ROOT__', "/online-exam");
    define('__EMAIL_ROOT__', "http://127.0.0.1:81/online-exam");

    $head = "
        <meta name='viewport' content='width=device-width,initial-scale=1.0' />
        <link rel='shortcut icon' href='" . __ROOT__ . "/images/logo/favicon.png' />
        <!-- <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' integrity='sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO' crossorigin='anonymous' /> -->
        <link rel='stylesheet' href='" . __ROOT__ . "/assets/css/bootstrap.min.css' />
        <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous' />
        <link rel='stylesheet' href='" . __ROOT__ . "/assets/css/default.css' />
    ";

    $header = "
    <header>
        <div id=\"header-top\" class=\"container-fluid\">
            <img class=\"d-inline-block\" src=\"" . __ROOT__ . "/images/logo/header.png\" alt=\"\">
    </header>
    ";

    $footer = "
    <footer>
        <div class='copyright'>All rights reserved to NIT Agartala</div>
    </footer>
    ";

    $script = "
        <script src='https://code.jquery.com/jquery-3.3.1.min.js' integrity='sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=' crossorigin='anonymous'></script>
        <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js' integrity='sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy' crossorigin='anonymous'></script>
    ";

?>
