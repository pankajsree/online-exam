<?php
    require_once("../../common/common.php");
    require_once("../../config/db-config.php");

    if(isset($_POST['submit'])) {
        $e_code = $_POST['e_code'];
        $query = "SELECT `sec_id` FROM `sec_details` WHERE `sec_id` LIKE '$e_code%'";
        $result = mysqli_query($conn, $query);
        if(!$result) {
            // die("Query Failed !!!" . mysqli_error($conn));
            die($query);
        }
        $sec_ids = array();
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $sec_ids[] = $row['sec_id'];
        }

        // echo $sec_ids[0] ."--" . $sec_ids[1] . "--" . $sec_ids[2];
        // die("--");

        $sec_count = $_POST['sec_count'];
        for($k = 1; $k <= $sec_count; $k ++) {
            $flag_id = "flag_" . $k;
            if($_POST[$flag_id] == 1) {
                $target_file = "../../data/answers_" . $k . ".csv";
                if (file_exists($target_file)) {
        		    unlink($target_file);
        		}
                $file_name = "ques_file_" . $k;
        		if (!move_uploaded_file($_FILES[$file_name]["tmp_name"], $target_file)) {
        			die("Sorry, there was an error uploading file, try to Upload it Later. Keep in mind, MAX Upload Size 2 Mb.");
            	}
                $j = $k - 1;
                $table = $sec_ids[$j] . "_ans";

                $query = "INSERT INTO `$table` (`ques_sl`, `answer`) VALUES ";
                $file = fopen($target_file, "r");

                $getData = fgetcsv($file, 5000, ",");
                $getData = preg_replace("/\xEF\xBB\xBF/", "", $getData);
                $query .= " ($getData[0], $getData[1]),";
                
                while (($getData = fgetcsv($file, 5000, ",")) !== FALSE)
                {
                    $query .= " ($getData[0], $getData[1]),";
                }
                fclose($file);
                $query = rtrim($query, ',');
                $result = mysqli_query($conn, $query);
                if(!$result) {
                    // die("Query Failed !!!" . mysqli_error($conn));
                    die($query);
                }
            }
        }

    ?>
    <script>
    alert("CSV File has been successfully Imported");
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
            .upload-mask {
                display: inline-block;
                padding: 1rem 2rem;
                background-color: rgba(0, 0, 0, 0.5);
                color: #fff;
                cursor: pointer;
                margin: 0.25rem;
            }
            .mar-top-2 {
                margin-top: 2rem;
            }
            .uploaded {
                background-color: rgba(0, 255, 0, 0.5);
            }
        </style>
    </head>
    <body>

        <main class="container">
            <form action="upload-answer" method="post" enctype="multipart/form-data">
                <input type="hidden" name="sec_count" value="<?= $sec_count ?>" />
                <input type="hidden" name="e_code" value="<?= $e_code ?>" />
                <div class="row">
                    <div class="col-12 text-center">
                        <?php
                            for($i = 1; $i <= $sec_count; $i ++) {
                        ?>
                        <div id="upload-mask-<?= $i ?>" data-serial="<?= $i ?>" class="upload-mask">Upload Section <?= $i ?> Questions (.csv)</div>
                        <input type="file" class="d-none" accept=".csv" id="ques_file_<?= $i ?>" data-serial="<?= $i ?>" name="ques_file_<?= $i ?>" />
                        <input type="hidden" id="flag_<?= $i ?>" name="flag_<?= $i ?>" value="0" />
                        <?php
                            }
                        ?>

                    </div>
                </div>

                <div class="mar-top-2 text-center">
                    <input type="submit" class="link-button" name="submit" value="Save Changes" />
                </div>
            </form>
        </main>

        <?= $script ?>
        <script>

            $(document).ready(function() {
                var input_id;
                var serial;
                var div_id;
                var flag_id;

                $(".upload-mask").click(function() {
                    serial = $(this).attr("data-serial");
                    input_id = "#ques_file_" + serial;
                    $(input_id).trigger("click");
                });

                var tags = document.querySelectorAll("input");

                for(var i = 0; i < tags.length; i++) {
                    tags[i].addEventListener("input", function() {
                        serial = $(this).attr("data-serial");
                        div_id = "#upload-mask-" + serial;
                        flag_id = "#flag_" + serial;
                        $(div_id).addClass("uploaded");
                        $(flag_id).val(1);
                    });
                }
            });

        </script>
    </body>
</html>
