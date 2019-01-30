<?php
    require_once("C:/wamp64/www/nita/common/common.php");
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

        <?= $nav ?>
        <main>
            <div class="container text-center">
                <h1>Error 500 - Internal Server Error</h1>
                <div class="row">
                  <div class="col-12">
                    <p>The server encountered an internal error. Please contact the server administrator at <a href="javascript:location='mailto:\u006b\u0061\u006d\u0061\u006c\u006d\u0063\u0061\u0030\u0033\u0040\u0067\u006d\u0061\u0069\u006c\u002e\u0063\u006f\u006d';void 0"><script type="text/javascript">document.write('\u006b\u0061\u006d\u0061\u006c\u006d\u0063\u0061\u0030\u0033\u0040\u0067\u006d\u0061\u0069\u006c\u002e\u0063\u006f\u006d')</script></a></p>
                    <p><a href="<?= __ROOT__ ?>/index">Click Here</a>, to go to the Homepage of <span class="bold-sp-2">NIT Agartala</span></p>
                  </div>
                </div>
            </div>
        </main>

        <?= $footer ?>
        <?= $script ?>
    </body>
</html>
