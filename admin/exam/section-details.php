<?php
    session_start();
    require_once("../../common/common.php");
    require_once("../session-timeout.php");
    require_once("../../config/db-config.php");
    require_once("../../helpers/token.php");


	if(isset($_POST['exam_code']) && Token::check($_POST['token'])) {
        $e_code = mysqli_real_escape_string($conn, $_POST['exam_code']);
        $sec_count = $_POST['sec_count'];

		$query_section = "INSERT INTO `sec_details` (`sec_id`, `sec_name`, `tot_ques`, `time_mins`, `positive`, `negative`, `note`) VALUES ";

        $values = "";
        $query_ques = "";
        $query_ans = "";
        $query_response = "";

        for($i = 1; $i <= $sec_count; $i ++) {
            $temp_id = "sec_id_" . $i;
            $temp_name = "sec_name_" . $i;
            $temp_tot_ques = "tot_ques_" . $i;
            $temp_time_mins = "time_mins_" . $i;
            $temp_positive = "positive_" . $i;
            $temp_negative = "negative_" . $i;
            $temp_note = "note_" . $i;

            $sec_id = $e_code . "_" . trim(mysqli_real_escape_string($conn, $_POST[$temp_id]));
            $sec_name = trim(mysqli_real_escape_string($conn, $_POST[$temp_name]));
            $tot_ques = trim(mysqli_real_escape_string($conn, $_POST[$temp_tot_ques]));
            $time_mins = trim(mysqli_real_escape_string($conn, $_POST[$temp_time_mins]));
            $positive = trim(mysqli_real_escape_string($conn, $_POST[$temp_positive]));
            $negative = trim(mysqli_real_escape_string($conn, $_POST[$temp_negative]));
            $note = trim(mysqli_real_escape_string($conn, $_POST[$temp_note]));

            $values .= "('$sec_id', '$sec_name', $tot_ques, $time_mins, $positive, $negative, '$note'),";

            $table_ques = $sec_id . "_ques";
            $table_ans = $sec_id . "_ans";
            $table_response = $sec_id . "_response";

            $query_ques .= "
                DROP TABLE IF EXISTS `$table_ques`;
                CREATE TABLE IF NOT EXISTS `$table_ques` (
                    `ques_sl` smallint(3) NOT NULL AUTO_INCREMENT,
                    `ques` varchar(1024) NOT NULL,
                    `opt_1` varchar(512) NOT NULL,
                    `opt_2` varchar(512) NOT NULL,
                    `opt_3` varchar(512) NOT NULL,
                    `opt_4` varchar(512) NOT NULL,
                    `image` varchar(256) NOT NULL,
                    PRIMARY KEY (`ques_sl`)
                );
            ";

            $query_ans .= "
                DROP TABLE IF EXISTS `$table_ans`;
                CREATE TABLE IF NOT EXISTS `$table_ans` (
                    `ques_sl` smallint(3) NOT NULL,
                    `answer` smallint(2) NOT NULL,
                    PRIMARY KEY (`ques_sl`)
                );
            ";

            $response_meta = "`candidate_id` varchar(32) NOT NULL,";
            for($j = 1; $j <= $tot_ques; $j ++) {
                $response_meta .= "`q" . $j . "` smallint(2) NOT NULL DEFAULT 0,";
            }
            $response_meta = rtrim($response_meta, ',');

            $query_response .= "
                DROP TABLE IF EXISTS `$table_response`;
                CREATE TABLE IF NOT EXISTS `$table_response` (
                    " . $response_meta . ",
                    PRIMARY KEY (`candidate_id`)
                );
            ";
        }

        $values = rtrim($values, ',');
        $query_section .= $values;

        $result= mysqli_query($conn, $query_section);
		if(!$result) {
			// die("Query Failed !!!");
			die($query_section);
		}
        // mysqli_free_result($result);

        $query_multi = $query_ques . $query_ans . $query_response;

        $result_ques= mysqli_multi_query($conn, $query_multi);
		if(!$result_ques) {
			// die("Query Failed !!!");
            echo mysqli_error($conn);
			die($query_multi);
		}

        ?>
        <script>
            alert("Exam Details Added Successfully");
            function redirect() {
                window.location = "../home";
            }
            setTimeout(redirect(), 5000);
        </script>
        <?php
	}
    else {
        $query = "SELECT `exam_code`, `sec_count` FROM `exam` ORDER BY `added_on` DESC LIMIT 1";
        $result = mysqli_query($conn, $query);
        if(!$result) {
            die($query);
        }
        $row = mysqli_fetch_assoc($result);
        $e_code = $row['exam_code'];
        $sec_count = $row['sec_count'];
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Edit Profile</title>
        <meta name="author" content="Pankajsree Das">
        <?= $head ?>
        <link rel="stylesheet" href="../../assets/css/admin.css" />
        <link rel="stylesheet" href="../../assets/css/form.css" />
    </head>
    <body>
        <?= $header ?>
        <main>
            <div class="container">
                <h1 class="mid-line"><span class="text">Section Details</span></h1>
                <form id="add-form" method="post" action="section-details">
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
                    <input type="hidden" name="exam_code" value="<?= $e_code ?>" />
                    <input type="hidden" name="sec_count" value="<?= $sec_count ?>" />

                    <?php
                        for($i = 1; $i <= $sec_count; $i ++) {
                    ?>

                    <div class="sec-indv">
                        <h2>
                            <span class="pad-h-1 b-b-black">Section <?= $i ?></span>
                        </h2>
                        <div class="row">
                            <div class="col-12"><input type="text" id="sec_id_<?= $i ?>" name="sec_id_<?= $i ?>" placeholder="Section ID" required /></div>
                        </div>
                        <div class="row">
                            <div class="col-12"><input type="text" id="sec_name_<?= $i ?>" name="sec_name_<?= $i ?>" placeholder="Section Name" required /></div>
                        </div>
                        <div class="row">
                            <div class="col-12"><input type="text" id="tot_ques_<?= $i ?>" name="tot_ques_<?= $i ?>" placeholder="Total Questions" required /></div>
                        </div>
                        <div class="row">
                            <div class="col-12"><input type="text" id="time_mins_<?= $i ?>" name="time_mins_<?= $i ?>" placeholder="Total Time(in mins)" required /></div>
                        </div>
                        <div class="row">
                            <div class="col-12"><input type="text" id="positive_<?= $i ?>" name="positive_<?= $i ?>" placeholder="Positive" required /></div>
                        </div>
                        <div class="row">
                            <div class="col-12"><input type="text" id="negative_<?= $i ?>" name="negative_<?= $i ?>" placeholder="Negative" required /></div>
                        </div>
                        <div class="row">
                            <div class="col-12"><textarea name="note_<?= $i ?>" id="note_<?= $i ?>" rows="3" placeholder="Notes about the section(if any)"></textarea></div>
                        </div>
                    </div>

                    <?php
                        }
                    ?>

                    <div class="row">
                        <div class="col-12 text-right">
                            <input type="submit" class="link-button" value="Add Section Details" />
                        </div>
                    </div>
                </form>
            </div>
        </main>

        <?= $script ?>
    </body>
</html>
