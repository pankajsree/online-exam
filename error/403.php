<?php
    require_once("C:/wamp64/www/nita/common/common.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <title>HTTP 403: Forbidden | NIT Agartala</title>
        <meta name="author" content="Pankajsree Das">
        <?= $head ?>
        <style type="text/css">

            main, h1, p {
              font-family: var(--font-2);
            }

            main {
                margin-top: 3rem;
                margin-bottom: 2rem;
            }

            h1 {
              font-size: 3rem;
              font-weight: 300;
            }

            p {
              font-size: 21px;
              font-weight: 200;
              margin-bottom: 20px;
            }

            .bold-sp-2 {
              font-weight: bold;
              letter-spacing: 2px;
            }

            main a {
              color: blue !important;
              text-decoration: none;
              font-weight: 400;
            }

            main a:hover {
                color: blue !important;
                text-decoration: underline;
                font-weight: 400;
            }

        </style>
    </head>

    <body>

        <?= $nav ?>
        <main>
            <div class="container text-center">
                <h1>Error 403 - Forbidden</h1>
                <div class="row">
                  <div class="col-12">
                    <p>You don't have permission to access this directory on this server.</p>
                    <p><a href="<?= __ROOT__ ?>/index">Click Here</a>, to go to the Homepage of <span class="bold-sp-2">NIT Agartala</span></p>
                  </div>
                </div>
            </div>
        </main>

        <?= $footer ?>
        <?= $script ?>
    </body>
</html>
