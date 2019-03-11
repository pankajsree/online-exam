<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/online-exam/common/common.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <title>HTTP 500: Internal Server Error | NIT Agartala</title>
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

        <?= $header ?>
        <main>
            <div class="container text-center">
                <h1>Error 500 - Internal Server Error</h1>
                <div class="row">
                  <div class="col-12">
                    <p>The server encountered an internal error. Please contact the Webmaster</p>
                    <p>Else <a href="<?= __ROOT__ ?>">Click Here</a>, to go to Login page</p>
                  </div>
                </div>
            </div>
        </main>

        <?= $footer ?>
        <?= $script ?>
    </body>
</html>
