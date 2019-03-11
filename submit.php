<?php
    session_start();
    require("common/common.php");
    require("config/db-config.php");

    $candidate_id = $_SESSION['candidate_id'];
    $query = "UPDATE `candidate` SET `candidate_exam_status` = 5 WHERE `candidate_id` = '$candidate_id'";
    $result = mysqli_query($conn, $query);
    if(!$result) {
        // die($query);
        die("CONTACT YOUR EXAM ADMIN, PAPER NOT SUBMITTED !!!");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Submit</title>
        <meta name="author" content="Pankajsree Das">
        <?= $head ?>
        <link rel="stylesheet" href="assets/css/submit.css" />
    </head>
    <body>
        <header>
            <div id="header-top" class="container-fluid">
                <img class="d-inline-block" src="<?= __ROOT__ ?>/images/logo/header.png" alt="">
        </header>
    <?php
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
    <?= $footer ?>
    </body>
</html>
