<?php
    session_start();
    require_once("../check-session.php");
    require("../../common/common.php");
    require("../../config/db-config.php");

    $query = "SELECT `sec_id`, `tot_ques`, `positive`, `negative` FROM `sec_details`";
    $result = mysqli_query($conn, $query);
    if(!$result) {
        die($query);
    }
    $row = mysqli_fetch_assoc($result);
    $sec_id = $row['sec_id'];
    $tot_ques = $row['tot_ques'];
    $positive = $row['positive'];
    $negative = $row['negative'];
    $response_table = $sec_id . "_response";
    $answer_table = $sec_id . "_ans";
    $result_table = $sec_id . "_result";

    $query = "SELECT `answer` FROM `$answer_table` ORDER BY `ques_sl`";
    $result = mysqli_query($conn, $query);
    if(!$result) {
        die($query);
    }
    $answers = array();
    $answers[0] = 0;
    $serial = 1;
    while($row = mysqli_fetch_assoc($result)) {
        $answers[$serial] = $row['answer'];
        $serial ++;
    }

    $query = "SELECT `candidate_id`,";
    for($i = 1; $i <= $tot_ques; $i ++) {
        $query .= "`q$i`,";
    }
    $query = rtrim($query, ',');
    $query .= " FROM `$response_table`";
    $result = mysqli_query($conn, $query);
    if(!$result) {
        die($query);
    }
    while($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
        $attempted = 0;
        $correct = 0;
        $incorrect = 0;
        $candidate_id = $row[0];
        $query = "UPDATE `$result_table` SET ";
        for($i = 1; $i <= $tot_ques; $i ++) {
            if($row[$i] != 0) {
                $attempted ++;
                if($answers[$i] == $row[$i]) {
                    $correct ++;
                }
                else {
                    $incorrect ++;
                }
            }
        }
        $score = ($correct * $positive) - ($incorrect * $negative);
        $query .= "`attempted` = $attempted, `correct` = $correct, `incorrect` = $incorrect, `score` = $score WHERE `candidate_id` = '$candidate_id'";
        $result_indv = mysqli_query($conn, $query);
        if(!$result_indv) {
            die($query);
        }
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
            Successfully Calculated Result <i class="far fa-smile"></i>
        </div>
    </body>
</html>
