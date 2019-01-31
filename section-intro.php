<?php
    session_start();
    require("common/common.php");
    require_once("config/db-config.php");
    require_once("helpers/check-login.php");

    $query = "SELECT `sec_id`, `sec_name`, `tot_ques`, `time_mins`, `positive`, `negative` FROM `sec_details`";
    $result = mysqli_query($conn, $query);
    if(!$result) {
        die($query);
    }
    $row_details = mysqli_fetch_assoc($result);

    $_SESSION['sec_id'] = $row_details['sec_id'];
    $_SESSION['sec_name'] = $row_details['sec_name'];
    $_SESSION['tot_ques'] = $row_details['tot_ques'];
    $_SESSION['DURATION'] = $row_details['time_mins'];

    $positive = $row_details['positive'];
    $negative = $row_details['negative'];

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Check Details</title>
        <meta name="author" content="Pankajsree Das">

        <?= $head ?>
        <!-- <link rel="stylesheet" href="assets/css/form.css" /> -->

    </head>
    <style>

        main {
            padding-top: 4rem;
        }

        .link-button {
            letter-spacing: 5px;
        }

        table {
            margin: 5rem auto;
            min-width: 50%;
        }

        td {
            border: 1px solid #111;
            padding: 0.75rem 1.5rem;
        }

    </style>
    <body>
        <header>
            <div id="header-top" class="container-fluid">
                <img class="d-inline-block" src="<?= __ROOT__ ?>/images/logo/header.png" alt="">
        </header>
        <main>
            <div class="container">
                <h1 class="mid-line"><span class="text">Section Details</span></h1>
                <table>
                    <tbody>
                        <tr>
                            <td>Section Name</td>
                            <td><?= $_SESSION['sec_name'] ?></td>
                        </tr>
                        <tr>
                            <td>Total Questions</td>
                            <td><?= $_SESSION['tot_ques'] ?></td>
                        </tr>
                        <tr>
                            <td>Total Time (mins)</td>
                            <td><?= $_SESSION['DURATION'] ?></td>
                        </tr>
                        <tr>
                            <td>Positive</td>
                            <td><?= $positive ?></td>
                        </tr>
                        <tr>
                            <td>Negative</td>
                            <td><?= $negative ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-center">
                    <a href="paper" class="link-button">Start Exam</a>
                </div>
            </div>
        </main>

    </body>
</html>
