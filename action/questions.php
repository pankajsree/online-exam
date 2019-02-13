<?php
    session_start();
    require("../common/common.php");
    require("../config/db-config.php");
    require("../helpers/ques-set.php");

    $candidate_id = $_SESSION['candidate_id'];
    $serial = $_POST['serial'];
    $questions = $_POST['json'];
    $response_table = $_SESSION['sec_id'] . "_response";

    $col = "q" . $serial;
    $query = "SELECT `$col` AS `original`, ABS(`$col`) AS `$col` FROM `$response_table` WHERE `candidate_id` = '$candidate_id'";
    // die($query);
    $result = mysqli_query($conn, $query);
    if(!$result) {
        echo mysqli_error($conn);
        die($query);
    }

    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    ?>
    <script>
        changeColor(<?= $serial ?>, <?= $row['original'] ?>);
    </script>
    <?php

    $response = "opt_" . $row[$col] . "_" . $serial;

    if($row[$col] == 0) {
        $query = "UPDATE `$response_table` SET `$col` = 5 WHERE `candidate_id` = '$candidate_id'";
        $result = mysqli_query($conn, $query);
        if(!$result) {
            echo mysqli_error($conn);
            die($query);
        }
    }

?>

<div class="ques-container">
    <?= updateQues($serial, $questions) ?>
</div>


<script>
    var response = "<?= $response ?>";
    var id;
    id = "#" + response;
    $(id).prop('checked', true);

    var sl_id;
    var sl_ques;

    $(".clear-sl").click(function() {
        sl_ques = $(this).attr("data-serial");
        sl_id = "#opt_5_" + sl_ques;
        $(sl_id).trigger('click');
    });
</script>
