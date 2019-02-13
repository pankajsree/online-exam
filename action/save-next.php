<?php
    session_start();
    require("../common/common.php");
    require("../config/db-config.php");
    require("../helpers/ques-set.php");

    $candidate_id = $_SESSION['candidate_id'];
    $serial = $_POST['serial'];
    $questions = $_POST['json'];
    $tot_ques = $_POST['tot_ques'];
    $response_table = $_SESSION['sec_id'] . "_response";

    if($_POST['res_1'] == 0) {
        $response = 5;
    }
    else {
        $response = $_POST['res_1'];
    }

    ?>
    <script>
        changeColor(<?= $serial ?>, <?= $response ?>);
    </script>
    <?php

    $query_response = "UPDATE `$response_table` SET ";
        $col = "q" . $serial;
        $query_response .= "`$col` = '$response'";
    $query_response .= " WHERE `candidate_id` = '$candidate_id'";
    $result = mysqli_query($conn, $query_response);
    if(!$result) {
        echo mysqli_error($conn);
        die($query_response);
    }

    if($serial != $tot_ques) {
        $serial ++;
    }
    else {
        $serial = 1;
    }

        $col = "q" . $serial;
    $query = "SELECT `$col` AS `original`, ABS(`$col`) AS `$col` FROM `$response_table` WHERE `candidate_id` = '$candidate_id'";
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
    // $json = json_encode($response);
    // die($response);

?>

<div class="ques-container">
    <?= updateQues($serial, $questions) ?>
</div>

<script>
    var response = "<?= $response ?>";
    // alert(response);
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
