<?php
    session_start();
    require_once("../check-session.php");
    require("../../common/common.php");
    require("../../config/db-config.php");

    $query = "SELECT `sec_id`, `tot_ques` FROM `sec_details`";
    $result = mysqli_query($conn, $query);
    if(!$result) {
        die($query);
    }
    $row = mysqli_fetch_assoc($result);
    $sec_id = $row['sec_id'];
    $tot_ques = $row['tot_ques'];
    $response_table = $sec_id . "_response";

    $query_update = "UPDATE `$response_table` SET ";
    for($i = 1; $i <= $tot_ques; $i ++) {
        $query_update .= "`q$i` = ABS(`q$i`),";
    }
    $query_update = rtrim($query_update, ',');
    // die($query_update);
    $result_update = mysqli_query($conn, $query_update);
    if(!$result_update) {
        die($query_update);
    }

    $query_update = "UPDATE `$response_table` SET ";
    for($i = 1; $i <= $tot_ques; $i ++) {
        $query_update .= "`q$i` = IF(`q$i` > 4, 0, `q$i`),";
    }
    $query_update = rtrim($query_update, ',');
    // die($query_update);
    $result_update = mysqli_query($conn, $query_update);
    if(!$result_update) {
        die($query_update);
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Pankajsree Das">
        <title>Arrange Responses</title>
        <?= $head ?>
        <link rel="stylesheet" href="../../assets/css/submit.css" />
    </head>
    <body>
        <header>
            <div id="header-top" class="container-fluid">
                <img class="d-inline-block" src="<?= __ROOT__ ?>/images/logo/header.png" alt="">
        </header>
        <div class="message">
            Successfully Arranged Responses <i class="far fa-smile"></i>
        </div>
        <?= $footer ?>
    </body>
</html>
