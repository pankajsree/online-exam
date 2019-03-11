<?php
    session_start();
    require_once("../check-session.php");
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
                $target_file = "../../data/questions_" . $k . ".csv";
                if (file_exists($target_file)) {
        		    unlink($target_file);
        		}
                $file_name = "ques_file_" . $k;
        		if (!move_uploaded_file($_FILES[$file_name]["tmp_name"], $target_file)) {
        			die("Sorry, there was an error uploading file, try to Upload it Later. Keep in mind, MAX Upload Size 2 Mb.");
            	}
                $j = $k - 1;
                $table = $sec_ids[$j] . "_ques";

                $query = "INSERT INTO `$table` (`ques`, `opt_1`, `opt_2`, `opt_3`, `opt_4`, `image`) VALUES ";
                $file = fopen($target_file, "r");
                while (($getData = fgetcsv($file, 5000, "\t")) !== FALSE)
                {
                    $query .= " ('$getData[0]','$getData[1]','$getData[2]','$getData[3]','$getData[4]','$getData[5]'),";
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
            window.location = "../dashboard";
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
        <link rel="stylesheet" href="../../assets/css/admin.css" />
    </head>
    <body>
        <?= $header ?>
        <main class="container">
            <h1 class="mid-line"><span class="text">Upload Questions</span></h1>
            <form action="upload-ques" method="post" enctype="multipart/form-data">
                <input type="hidden" name="sec_count" value="<?= $sec_count ?>" />
                <input type="hidden" name="e_code" value="<?= $e_code ?>" />
                <div class="row">
                    <div class="col-12 text-center">
                        <?php
                            for($i = 1; $i <= $sec_count; $i ++) {
                        ?>
                        <div id="upload-mask-<?= $i ?>" data-serial="<?= $i ?>" class="upload-mask">Select Section <?= $i ?> Questions File (.csv)</div>
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
        <?= $footer ?>
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
