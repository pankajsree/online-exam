<?php
    session_start();
    require("../common/common.php");
    require("../config/db-config.php");
    require("../helpers/ques-set.php");

    $candidate_id = 'cse_033_001';
    $serial = $_POST['serial'];
    $questions = $_POST['json'];
    $tot_ques = $_POST['tot_ques'];
    $response_table = "cse_033_phy_response";

    if($_POST['res_1'] >= 1 && $_POST['res_1'] <= 4) {
        $response = $_POST['res_1'] * (-1);
    }
    else {
        $response = 6;
    }

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
    $query = "SELECT ABS(`$col`) AS `$col` FROM `$response_table` WHERE `candidate_id` = '$candidate_id'";
    $result = mysqli_query($conn, $query);
    if(!$result) {
        echo mysqli_error($conn);
        die($query);
    }

    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

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
