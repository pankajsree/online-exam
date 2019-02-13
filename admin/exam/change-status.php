<?php
    session_start();
    require_once("../check-session.php");
    require_once("../../common/common.php");
    require_once("../../config/db-config.php");
    require_once("../../helpers/token.php");


	if(isset($_POST['is_active']) && Token::check($_POST['token'])) {
        $is_active = $_POST['is_active'];
        $exam_code = $_POST['exam_code'];

        $query = "UPDATE `exam` SET `is_active` = $is_active WHERE `exam_code` = '$exam_code'";
        $result = mysqli_query($conn, $query);
        if(!$result) {
            die($query);
        }

        if($is_active == 1) {
            $query = "SELECT `time_mins` FROM `sec_details` WHERE `sec_id` LIKE '$exam_code%'";
            $result = mysqli_query($conn, $query);
            if(!$result) {
                die($query);
            }
            $row = mysqli_fetch_assoc($result);
            $time_mins = $row['time_mins'];
            $time_left = 60 * $time_mins;

            $query = "UPDATE `candidate` SET `time_left` = $time_left";
            $result = mysqli_query($conn, $query);
            if(!$result) {
                die($query);
            }
        }
        ?>
        <script>
            alert("Exam Status changed Successfully");
            window.location = "../dashboard";
        </script>
        <?php
	}
    else {
        $query = "SELECT `exam_code`, `exam_name`, `is_active` FROM `exam` WHERE `is_active` <> 5";
        $result = mysqli_query($conn, $query);
        if(!$result) {
            die($query);
        }
        $row = mysqli_fetch_assoc($result);
        $exam_code = $row['exam_code'];
        $exam_name = $row['exam_name'];
        $is_active = $row['is_active'];
        $is_active_id = "#" . $exam_code . "-" . $is_active;
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
        <style>
            form {
                max-width: 1140px;
            }
            .heading {
                position: relative;
                display: inline-block;
                font-size: 1.25rem;
                padding-bottom: 0.25rem;
                font-weight: bold;
                letter-spacing: 1px;
            }
            .heading:after {
                content: '';
                position: absolute;
                left: 0;
                bottom: 0;
                width: 100%;
                height: 1px;
                background-color: #000;
            }
            input[type="radio"] {
                width: auto;
                padding: 0;
                cursor: pointer;
                width: 1.5rem;
                height: 1.5rem;
            }
        </style>
        <?= $script ?>
    </head>
    <body>
        <?= $header ?>
        <main>
            <div class="container">
                <h1 class="mid-line"><span class="text">Change Exam Status</span></h1>
                <form id="status-form" method="post" action="">
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
                    <div class="row">
                        <div class="col-3">
                            <div class="heading">Exam Code</div>
                        </div>
                        <div class="col-3">
                            <div class="heading">Exam Name</div>
                        </div>
                        <div class="col-2 text-center">
                            <div class="heading">Inactive</div>
                        </div>
                        <div class="col-2 text-center">
                            <div class="heading">Active</div>
                        </div>
                        <div class="col-2 text-center">
                            <div class="heading">De-Activate</div>
                        </div>
                    </div>
                    <input type="hidden" name="exam_code" value="<?= $exam_code ?>" />
                    <div class="row">
                        <div class="col-3">
                            <?= $exam_code ?>
                        </div>
                        <div class="col-3">
                            <?= $exam_name ?>
                        </div>
                        <div class="col-2 text-center">
                            <input type="radio" id="<?= $exam_code ?>-0" name="is_active" value="0" />
                        </div>
                        <div class="col-2 text-center">
                            <input type="radio" id="<?= $exam_code ?>-1" name="is_active" value="1" />
                        </div>
                        <div class="col-2 text-center">
                            <input type="radio" id="<?= $exam_code ?>-5" name="is_active" value="5" />
                        </div>
                    </div>
                    <script>
                        $("<?= $is_active_id ?>").prop("checked", true);
                    </script>
                    <div class="row">
                        <div class="col-12 text-right">
                            <input type="submit" class="link-button" value="Save Changes" />
                        </div>
                    </div>
                </form>
            </div>
        </main>


    </body>
</html>
