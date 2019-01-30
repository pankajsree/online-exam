<?php
    session_start();
    require("../config/db-config.php");

    $candidate_id = $_SESSION['candidate_id'];

    $query_timer = "UPDATE `candidate` SET `time_left` = `time_left` - 30 WHERE `candidate_id` = '$candidate_id'";
    $result_timer = mysqli_query($conn, $query_timer);
    if(!$result_timer) {
        echo mysqli_error($conn);
        die($query_timer);
    }
?>
