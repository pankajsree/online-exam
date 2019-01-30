<?php
    require_once("../common/common.php");
    require_once("../config/db-config.php");

    if(isset($_POST['submit'])) {
            $target_file = "../meta/user.json";
            if (file_exists($target_file)) {
    		    unlink($target_file);
    		}

    		if (!move_uploaded_file($_FILES["data-file"]["tmp_name"], $target_file)) {
    			die("Sorry, there was an error uploading file, try to Upload it Later. Keep in mind, MAX Upload Size 2 Mb.");
        	}

            $file = file_get_contents('../meta/user.json');
        	$meta = json_decode($file, true);

            $user_count = $meta['user_count'];
            $exam_name = $meta['exam_name'];
            $sec_count = $meta['no_of_sections'];

            $query_exam = "INSERT INTO `candidate_details` (`exam_code`, `exam_name`, `sec_count`) VALUES ('$exam_code', '$exam_name', '$sec_count')";

            $query_details = "INSERT INTO `sec_details` (`sec_id`, `sec_name`, `tot_ques`, `time_mins`, `positive`, `negative`, `note`) VALUES ";

            $query_ques = "INSERT INTO `sec_ques` (`sec_id`, `ques_sl`, `ques`, `opt_1`, `opt_2`, `opt_3`, `opt_4`, `answer`, `image`) VALUES ";

            for($i = 1; $i <= $sec_count; $i ++) {
                $sec_key = "sec_" . $i;

                $sec_id = $exam_code . "_" . $meta[$sec_key]['id'];
                $sec_name = $meta[$sec_key]['name'];
                $tot_ques = $meta[$sec_key]['total_ques'];
                $time_mins = $meta[$sec_key]['time_mins'];
                $positive = $meta[$sec_key]['positive'];
                $negative = $meta[$sec_key]['negative'];
                $note = $meta[$sec_key]['note'];

                $query_details .= "('$sec_id', '$sec_name', $tot_ques, $time_mins, $positive, $negative, '$note'),";

                for($j = 1; $j <= $tot_ques; $j ++) {
                    $ques = $meta[$sec_key]['questions'][$j]['ques'];
                    $opt_1 = $meta[$sec_key]['questions'][$j]['option_1'];
                    $opt_2 = $meta[$sec_key]['questions'][$j]['option_2'];
                    $opt_3 = $meta[$sec_key]['questions'][$j]['option_3'];
                    $opt_4 = $meta[$sec_key]['questions'][$j]['option_4'];
                    $answer = $meta[$sec_key]['questions'][$j]['answer'];
                    $image = $meta[$sec_key]['questions'][$j]['image'];

                    $query_ques .= "('$sec_id', $j, '$ques', '$opt_1', '$opt_2', '$opt_3', '$opt_4', $answer, '$image'),";
                }
            }

            $query_details = rtrim($query_details, ',');
            $query_ques = rtrim($query_ques, ',');

            // echo $query_exam;
            // echo "---------------------";
            // echo $query_details;
            // echo "---------------------";
            // echo $query_ques;
            // die("---------------------");

            $result_exam = mysqli_query($conn, $query_exam);
            if(!$result_exam) {
                // die("Query Failed !!!" . mysqli_error($conn));
                die($query_exam);
            }

            $result_details = mysqli_query($conn, $query_details);
            if(!$result_details) {
                // die("Query Failed !!!" . mysqli_error($conn));
                die($query_details);
            }

            $result_ques = mysqli_query($conn, $query_ques);
            if(!$result_ques) {
                // die("Query Failed !!!" . mysqli_error($conn));
                die($query_ques);
            }

    ?>
    <script>
    alert("Exam Details Added Successfully");
        function redirect() {
            window.location = "add-exam";
        }
        setTimeout(redirect(), 5000);

    </script>
    <?php
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Modify Corporate Services</title>
        <?= $head ?>
        <style>
            main {
                padding-top: 5rem;
                padding-bottom: 5rem;
            }
            .link-button {
                letter-spacing: 2px;
            }
            #upload-mask {
                display: inline-block;
                padding: 1rem 2rem;
                background-color: rgba(0, 0, 0, 0.5);
                color: #fff;
                cursor: pointer;
            }
        </style>
    </head>
    <body>

        <main class="container">
            <form action="add-exam.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12">
                        <div id="upload-mask">Upload JSON File</div>
                    </div>
                </div>
                <input type="file" class="d-none" accept="application/JSON" id="data-file" name="data-file" />
                <div class="text-right">
                    <input type="submit" class="link-button" name="submit" value="Save Changes" />
                </div>
            </form>
        </main>

        <?= $script ?>
        <script>

            $(document).ready(function() {
                $("#upload-mask").click(function() {
                    $("#data-file").trigger("click");
                });
            });

        </script>
    </body>
</html>
