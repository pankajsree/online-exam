<?php
    session_start();
    require_once("../check-session.php");
    require_once("../../common/common.php");
    require_once("../../config/db-config.php");

    if(isset($_POST['exam_code'])) {
        if($_POST['flag_candidate'] == 1) {
            $exam_code = $_POST['exam_code'];
            $target_file = "../../data/candidate.csv";
            if (file_exists($target_file)) {
    		    unlink($target_file);
    		}
            $file_name = "candidate_file";
    		if (!move_uploaded_file($_FILES[$file_name]["tmp_name"], $target_file)) {
    			die("Sorry, there was an error uploading file, try to Upload it Later. Keep in mind, MAX Upload Size 2 Mb.");
        	}

            $query = "SELECT `sec_id` FROM `sec_details` WHERE `sec_id` LIKE '$exam_code%'";
            $result = mysqli_query($conn, $query);
            if(!$result) {
                // die("Query Failed !!!" . mysqli_error($conn));
                die($query);
            }
            $row = mysqli_fetch_assoc($result);
            $table_response = $row['sec_id'] . "_response";
            $table_result = $row['sec_id'] . "_result";

            $query_response = "INSERT INTO `$table_response` (`candidate_id`) VALUES ";

            $query_result = "INSERT INTO `$table_result` (`candidate_id`, `candidate_name`) VALUES ";

            $query = "INSERT INTO `candidate` (`candidate_id`, `candidate_name`, `candidate_care_of`, `candidate_email`, `candidate_contact_no`) VALUES ";
            $file = fopen($target_file, "r");

            $getData = fgetcsv($file, 5000, ",");
            $getData = preg_replace("/\xEF\xBB\xBF/", "", $getData);
            $query .= " ('$getData[0]', '$getData[1]', '$getData[2]', '$getData[3]', '$getData[4]'),";
            $query_response .= " ('$getData[0]'),";
            $query_result .= " ('$getData[0]', '$getData[1]'),";

            while (($getData = fgetcsv($file, 5000, ",")) !== FALSE)
            {
                $query .= " ('$getData[0]', '$getData[1]', '$getData[2]', '$getData[3]', '$getData[4]'),";
                $query_response .= " ('$getData[0]'),";
                $query_result .= " ('$getData[0]', '$getData[1]'),";
            }
            fclose($file);
            $query = rtrim($query, ',');
            $query_response = rtrim($query_response, ',');
            $query_result = rtrim($query_result, ',');
            $result = mysqli_query($conn, $query);
            if(!$result) {
                // die("Query Failed !!!" . mysqli_error($conn));
                die($query);
            }

            $result_response = mysqli_query($conn, $query_response);
            if(!$result_response) {
                // die("Query Failed !!!" . mysqli_error($conn));
                die($query_response);
            }

            $result_result = mysqli_query($conn, $query_result);
            if(!$result_result) {
                // die("Query Failed !!!" . mysqli_error($conn));
                die($query_result);
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
        $query = "SELECT `exam_code` FROM `exam` ORDER BY `added_on` DESC LIMIT 1";
        $result = mysqli_query($conn, $query);
        if(!$result) {
            die($query);
        }
        $row = mysqli_fetch_assoc($result);
        $e_code = $row['exam_code'];
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Modify Corporate Services</title>
        <?= $head ?>
        <link rel="stylesheet" href="../../assets/css/admin.css" />
        <link rel="stylesheet" href="../../assets/css/form.css" />
    </head>
    <body>
        <?= $header ?>
        <main class="container">
            <h1 class="mid-line"><span class="text">Add Candidates</span></h1>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" id="exam_code" name="exam_code" class="tbl-col" value="<?= $e_code ?>" />
                <div class="row">
                    <div class="col-12 text-center">
                        <div id="upload-mask-candidate" class="upload-mask">Select Candidate List File (.csv)</div>
                        <input type="file" class="d-none" accept=".csv" id="candidate_file" name="candidate_file" required />
                        <input type="hidden" id="flag_candidate" name="flag_candidate" value="0" />
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
                $(".upload-mask").click(function() {
                    $("#candidate_file").trigger("click");
                });

                var tag = document.getElementById('candidate_file');
                tag.addEventListener("input", function() {
                    $("#upload-mask-candidate").addClass("uploaded");
                    $("#flag_candidate").val(1);
                });
            });

        </script>
    </body>
</html>
