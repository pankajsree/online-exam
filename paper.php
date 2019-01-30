<?php
    session_start();
    require("common/common.php");
    require("config/db-config.php");
    require("helpers/ques-set.php");

    $_SESSION['candidate_id'] = "cse_033_001";
    $_SESSION['candidate_name'] = "Pankajsree Das";
    $_SESSION['serial'] = 1;

    $serial = $_SESSION['serial'];
    $candidate_id = $_SESSION['candidate_id'];
    $candidate_name = $_SESSION['candidate_name'];

    /*************************/


    $response_table = "cse_033_phy_response";

    $col = "q" . $serial;
    $query = "SELECT `$col` FROM `$response_table` WHERE `candidate_id` = '$candidate_id'";
    $result = mysqli_query($conn, $query);
    if(!$result) {
        echo mysqli_error($conn);
        die($query);
    }

    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $response = "opt_" . $row[$col] . "_" . $serial;

    if($row[$col] == 0) {
        $query = "UPDATE `$response_table` SET `$col` = 5 WHERE `candidate_id` = '$candidate_id'";
        $result = mysqli_query($conn, $query);
        if(!$result) {
            echo mysqli_error($conn);
            die($query);
        }
    }

    $query_time_left = "SELECT `time_left` FROM `candidate` WHERE `candidate_id` = '$candidate_id'";
    $result_time_left = mysqli_query($conn, $query_time_left);
    if(!$result_time_left) {
        echo mysqli_error($conn);
        die($query_time_left);
    }
    $row_time_left = mysqli_fetch_assoc($result_time_left);
    $time_left = $row_time_left['time_left'];

    /*************************/

    // $exam_code = $_GET['exam_code'];
    // $get_sec = $_GET['sec_id'];

    $exam_code = "cse_033";
    $get_sec = "phy";

    $sec = $exam_code . "_" . $get_sec;

    $query = "SELECT `exam_name` FROM `exam` WHERE `exam_code` = '$exam_code'";
    $result = mysqli_query($conn, $query);
    if(!$result) {
        die($query);
    }
    $row_exam = mysqli_fetch_assoc($result);
    $exam_name = $row_exam['exam_name'];

    $query = "SELECT `sec_name`, `tot_ques`, `time_mins` FROM `sec_details` WHERE `sec_id` = '$sec'";
    $result = mysqli_query($conn, $query);
    if(!$result) {
        die($query);
    }
    $row_details = mysqli_fetch_assoc($result);

    $sec_name = $row_details['sec_name'];
    $tot_ques = $row_details['tot_ques'];
    $time_mins = $row_details['time_mins'];

    $_SESSION['DURATION'] = $time_mins;

    $table_response = $sec . "_response";
    $query_response = "SELECT `candidate_id`,";
    for($i = 1; $i <= $tot_ques; $i ++) {
        $query_response .= "`q" . $i . "`,";
    }
    $query_response = rtrim($query_response, ',');
    $query_response .= " FROM `$table_response` WHERE `candidate_id` = '$candidate_id'";
    $result_response = mysqli_query($conn, $query_response);
    $row_response = mysqli_fetch_array($result_response, MYSQLI_NUM);

    $db_responses = $row_response;
    $json_response = json_encode($db_responses);

    $table_ques = $sec . "_ques";

    $query = "SELECT `ques_sl`, `ques`, `opt_1`, `opt_2`, `opt_3`, `opt_4`, `image` FROM `$table_ques`";
    $result = mysqli_query($conn, $query);
    if(!$result) {
        die($query);
    }

    $questions = array();
    while($row_ques =mysqli_fetch_assoc($result)) {
        $questions[] = $row_ques;
    }

    $json = json_encode($questions);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Online Examination Application</title>
        <?= $head ?>
        <link rel='stylesheet' href='<?= __ROOT__ ?>/assets/css/paper.css' />
    </head>
    <body>
        <header>
            <div id="header-top" class="container-fluid">
                <img class="d-inline-block" src="<?= __ROOT__ ?>/images/logo/header.png" alt="">
                <table class="candi-det">
                    <tr>
                        <td class="label">Candidate Name&nbsp;</td>
                        <td>:&nbsp;</td>
                        <td id="candi-name"><?= $candidate_name ?></td>
                    </tr>
                    <tr>
                        <td class="label">Candidate ID&nbsp;</td>
                        <td>:&nbsp;</td>
                        <td id="candi-enroll"><?= $candidate_id ?></td>
                    </tr>
                    <tr>
                        <td class="label">Remaining Time&nbsp;</td>
                        <td>:&nbsp;</td>
                        <td id="time-left"></td>
                    </tr>
                </table>
            </div>
            <div class="exam-det">
                <div class="no-pad container-fluid">
                    <span id="section-name"><?= $sec_name ?></span>
                    <span id="exam-name"><?= $exam_name ?></span>
                </div>
            </div>
        </header>

        <main class="container">
            <div class="row">
                <div class="col-7">
                    <div id="ques-set">
                        <div class="ques-container">
                            <?= updateQues(1, $questions) ?>
                        </div>
                    </div>


                    <div class="response-container">
                        <div class="mark-response">
                            <button type="button" name="sv-nxt" id="sv-nxt" class="button" data-serial="1">Save &amp; Next</button>
                            <button type="button" name="sv-re" id="sv-re" class="button" data-serial="1">Save &amp; Mark for Review</button>
                            <button type="button" name="re-nxt" id="re-nxt" class="button" data-mark="1" data-serial="2">Mark for Review &amp; Next</button>
                        </div>
                        <div class="clear-response">
                            <button type="button" name="clear" id="clear" class="button clear-sl" data-serial="<?= $serial ?>">Clear&nbsp;Response</button>
                        </div>
                    </div>

                    <div class="navigate-container">
                        <div class="next-prev">
                            <button type="button" name="prev" id="prev" data-serial="<?= $tot_ques ?>">&lt;&lt; Prev</button>
                            <button type="button" name="next" id="next" data-serial="2">Next &gt;&gt;</button>
                        </div>
                        <button type="button" name="submit" id="submit">Submit</button>
                    </div>
                </div>


                <div class="col-5">
                    <div class="response-status">
                        <div class="row">
                            <div class="col-6">
                                <div id="not-visited" class="circle">150</div><span class="text">Not Visited</span>
                            </div>
                            <div class="col-6">
                                <div id="not-answered" class="circle">50</div><span class="text">Not Answered</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div id="answered" class="circle">150</div><span class="text">Answered</span>
                            </div>
                            <div class="col-6">
                                <div id="marked-re" class="circle">50</div><span class="text">Marked for Review</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div id="ans-marked-re" class="circle">150</div><span class="text">Answered & Marked for Review (will be considered for evaluation)</span>
                            </div>
                        </div>
                    </div>

                    <?php
                        $display = "<div class=\"response-sl-status\">";
                        for($k = 1; $k <= $tot_ques; $k ++) {
                            $display .= "<div id=\"ques-sl-btn-" . $k . "\" class=\"ques-sl-btn\" data-serial=\"" . $k . "\">" . $k . "</div>";
                        }
                        $display .= "</div>";
                        echo $display;
                    ?>

                </div>
            </div>

        </main>

        <?= $script ?>

        <script>
            var response = "<?= $response ?>";
            var db_response = '<?= $json_response ?>';
            var db_responses = JSON.parse(db_response);
            var i;
            var tot_ques = parseInt("<?= $tot_ques ?>");
            var btn;
            for(i = 1; i <= tot_ques; i ++) {
                btn = "#ques-sl-btn-" + i;
                // alert(db_responses[i]);
                switch (db_responses[i]) {
                    case '1':
                    case '2':
                    case '3':
                    case '4':
                        $(btn).attr("class", "ques-sl-btn sl-answered");
                        break;
                    case '5':
                        $(btn).attr("class", "ques-sl-btn sl-not-answered");
                        break;
                    case '6':
                        $(btn).attr("class", "ques-sl-btn sl-marked-re");
                        break;
                        case '-1':
                        case '-2':
                        case '-3':
                        case '-4':
                            $(btn).attr("class", "ques-sl-btn sl-ans-marked-re");
                            break;
                    default:
                        $(btn).attr("class", "ques-sl-btn sl-not-visited");
                        break;
                }
            }

            var id;
            id = "#" + response;
            $(id).prop('checked', true);

            var serial = 0;
            var mark_serial = 0;
            var data_next = 0;
            var cur_serial = 0;
            var data_prev = 0;
            var res_1;
            var json = <?= $json ?>;

            /*****     Countdown-Timer     *****/

            var time_left = parseInt("<?= $time_left ?>");

            var hrs;
            var mins;
            var secs;

            function fiveMinLeft() {
                alert("Less than 5 Minutes Left !!! Hurry up");
            }

            var countDown = setInterval(function() {
                time_left --;
                if(time_left > 0) {
                    hrs = Math.floor(time_left / 3600);
                    mins = Math.floor((time_left % 3600) / 60);
                    secs = Math.floor(time_left % 60);

                    if(parseInt(hrs) < 10) { hrs = "0" + hrs; }
                    if(parseInt(mins) < 10) { mins = "0" + mins; }
                    if(parseInt(secs) < 10) { secs = "0" + secs; }

                    $("#time-left").html(hrs + ' : ' + mins + ' : ' + secs);
                }
                else {
                    clearInterval(countDown);

                    $("#time-left").html("00 : 00 : 00");
                }
            }, 1000);

            var ajaxTimer = setInterval(function() {
                if(time_left < 310 && time_left > 290) {
                    fiveMinLeft();
                }
                $.ajax({
                    url: 'action/timer.php',
                    type: 'post',
                    data: {},
                    success: function(result) {},
                    error: function(){
                        alert("Something went Wrong with Timer !!!");
                    }
                });
            }, 30000);

            $(".ques-sl-btn").click(function() {
                serial = $(this).attr("data-serial");
                if(parseInt(serial) == 1) {
                    data_prev = tot_ques;
                    data_next = parseInt(serial) + 1;
                }
                else if(parseInt(serial) == tot_ques) {
                    data_prev = parseInt(serial) - 1;
                    data_next = 1;
                }
                else {
                    data_next = parseInt(serial) + 1;
                    data_prev = parseInt(serial) - 1;
                }

                // alert(serial + data_next + data_prev);
                $.ajax({
                    url: 'action/questions.php',
                    type: 'post',
                    data: {serial:serial, json:json},
                    success: function(result) {
                        $("#ques-set").html(result);
                        // alert(serial);
                        $("#sv-nxt").attr("data-serial", serial);
                        $("#sv-re").attr("data-serial", serial);
                        $("#next").attr("data-serial", data_next);
                        $("#prev").attr("data-serial", data_prev);
                        $("#re-nxt").attr("data-serial", data_next);
                        $("#re-nxt").attr("data-mark", serial);
                    },
                    error: function(){
                        alert("Something went Wrong !!! . . .");
                    }
                });
            });

            $("#sv-nxt").click(function() {
                serial = $(this).attr("data-serial");
                cur_serial = parseInt(serial);
                data_prev = cur_serial;
                if(parseInt(serial) == 1) {
                    // data_prev = tot_ques;
                    data_next = parseInt(serial) + 1;
                }
                else if(parseInt(serial) == tot_ques) {
                    // data_prev = parseInt(serial) - 1;
                    data_next = 1;
                }
                else {
                    data_next = parseInt(serial) + 1;
                    // data_prev = parseInt(serial) - 1;
                }
                serial = data_next;
                if(parseInt(serial) == tot_ques) {
                    data_next = 1;
                }
                else {
                    data_next ++;
                }

                res_1 =$('input:radio[name=option_' + cur_serial + ']:checked').val();

                $.ajax({
                    url: 'action/save-next.php',
                    type: 'post',
                    data: {
                        serial:cur_serial,
                        json:json,
                        res_1:res_1,
                        tot_ques:tot_ques
                    },
                    success: function(result) {
                        $("#ques-set").html(result);
                        $("#sv-nxt").attr("data-serial", serial);
                        $("#sv-re").attr("data-serial", serial);
                        $("#next").attr("data-serial", data_next);
                        $("#prev").attr("data-serial", data_prev);
                        $("#re-nxt").attr("data-serial", data_next);
                        $("#re-nxt").attr("data-mark", serial);
                    },
                    error: function(){
                        alert("Something went Wrong !!! . . .");
                    }
                });
            });

            $("#sv-re").click(function() {
                serial = $(this).attr("data-serial");
                cur_serial = parseInt(serial);
                data_prev = cur_serial;
                if(parseInt(serial) == 1) {
                    // data_prev = tot_ques;
                    data_next = parseInt(serial) + 1;
                }
                else if(parseInt(serial) == tot_ques) {
                    // data_prev = parseInt(serial) - 1;
                    data_next = 1;
                }
                else {
                    data_next = parseInt(serial) + 1;
                    // data_prev = parseInt(serial) - 1;
                }
                serial = data_next;
                if(parseInt(serial) == tot_ques) {
                    data_next = 1;
                }
                else {
                    data_next ++;
                }

                res_1 =$('input:radio[name=option_' + cur_serial + ']:checked').val();

                $.ajax({
                    url: 'action/save-mark.php',
                    type: 'post',
                    data: {
                        serial:cur_serial,
                        json:json,
                        res_1:res_1,
                        tot_ques:tot_ques
                    },
                    success: function(result) {
                        $("#ques-set").html(result);
                        $("#sv-nxt").attr("data-serial", serial);
                        $("#sv-re").attr("data-serial", serial);
                        $("#next").attr("data-serial", data_next);
                        $("#prev").attr("data-serial", data_prev);
                        $("#re-nxt").attr("data-serial", data_next);
                        $("#re-nxt").attr("data-mark", serial);
                    },
                    error: function(){
                        alert("Something went Wrong !!! . . .");
                    }
                });
            });

            $("#re-nxt").click(function() {
                serial = $(this).attr("data-serial");
                mark_serial = $(this).attr("data-mark");
                if(parseInt(serial) == 1) {
                    data_prev = tot_ques;
                    data_next = parseInt(serial) + 1;
                }
                else if(parseInt(serial) == tot_ques) {
                    data_prev = parseInt(serial) - 1;
                    data_next = 1;
                }
                else {
                    data_next = parseInt(serial) + 1;
                    data_prev = parseInt(serial) - 1;
                }

                $.ajax({
                    url: 'action/mark-next.php',
                    type: 'post',
                    data: {
                        serial:serial,
                        mark_serial:mark_serial,
                        json:json
                    },
                    success: function(result) {
                        $("#ques-set").html(result);
                        $("#sv-nxt").attr("data-serial", serial);
                        $("#sv-re").attr("data-serial", serial);
                        $("#next").attr("data-serial", data_next);
                        $("#prev").attr("data-serial", data_prev);
                        $("#re-nxt").attr("data-serial", data_next);
                        $("#re-nxt").attr("data-mark", serial);
                    },
                    error: function(){
                        alert("Something went Wrong !!! . . .");
                    }
                });
            });

            $("#next").click(function() {
                serial = $(this).attr("data-serial");
                if(parseInt(serial) == 1) {
                    data_prev = tot_ques;
                    data_next = parseInt(serial) + 1;
                }
                else if(parseInt(serial) == tot_ques) {
                    data_prev = parseInt(serial) - 1;
                    data_next = 1;
                }
                else {
                    data_next = parseInt(serial) + 1;
                    data_prev = parseInt(serial) - 1;
                }

                $.ajax({
                    url: 'action/next.php',
                    type: 'post',
                    data: {
                        serial:serial,
                        json:json
                    },
                    success: function(result) {
                        $("#ques-set").html(result);
                        $("#sv-nxt").attr("data-serial", serial);
                        $("#sv-re").attr("data-serial", serial);
                        $("#next").attr("data-serial", data_next);
                        $("#prev").attr("data-serial", data_prev);
                        $("#re-nxt").attr("data-serial", data_next);
                        $("#re-nxt").attr("data-mark", serial);
                    },
                    error: function(){
                        alert("Something went Wrong !!! . . .");
                    }
                });
            });

            $("#prev").click(function() {
                serial = $(this).attr("data-serial");
                if(parseInt(serial) == 1) {
                    data_prev = tot_ques;
                    data_next = parseInt(serial) + 1;
                }
                else if(parseInt(serial) == tot_ques) {
                    data_prev = parseInt(serial) - 1;
                    data_next = 1;
                }
                else {
                    data_next = parseInt(serial) + 1;
                    data_prev = parseInt(serial) - 1;
                }

                $.ajax({
                    url: 'action/prev.php',
                    type: 'post',
                    data: {
                        serial:serial,
                        json:json
                    },
                    success: function(result) {
                        $("#ques-set").html(result);
                        $("#sv-nxt").attr("data-serial", serial);
                        $("#sv-re").attr("data-serial", serial);
                        $("#next").attr("data-serial", data_next);
                        $("#prev").attr("data-serial", data_prev);
                        $("#re-nxt").attr("data-serial", data_next);
                        $("#re-nxt").attr("data-mark", serial);
                    },
                    error: function(){
                        alert("Something went Wrong !!! . . .");
                    }
                });
            });

            var sl_id;
            var sl_ques;

            $(".clear-sl").click(function() {
                sl_ques = $(this).attr("data-serial");
                sl_id = "#opt_5_" + sl_ques;
                $(sl_id).trigger('click');
            });

            $("#submit").click(function() {
                $.ajax({
                    url: 'submit.php',
                    type: 'post',
                    data: {},
                    success: function(result) {
                        alert("Logged Out");
                    },
                    error: function(){
                        alert("Something went Wrong !!! . . .");
                    }
                });
            });
        </script>
    </body>
</html>
