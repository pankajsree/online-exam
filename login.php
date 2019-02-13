<?php
    session_start();
    require("common/common.php");
    require_once("config/db-config.php");
    require_once("helpers/token.php");

    if(isset($_SESSION['candidate_id'])) {
        header("Location: check-details");
    }

    if(isset($_POST['submit'])) {
        if ($_SESSION['code'] != $_POST["captcha"]) {
            ?>
            <script>
                alert("Captcha didn't match !!!");
            </script>
            <?php
        }
        else {
            if(isset($_POST['token']) && Token::check($_POST['token'])) {
                session_regenerate_id(true);
                $chk_exam_code = mysqli_real_escape_string($conn, $_POST['exam_code']);
                $chk_candidate_id = mysqli_real_escape_string($conn, $_POST['candidate_id']);
                $chk_exam_password = mysqli_real_escape_string($conn, $_POST['exam_password']);

                $query = "SELECT `candidate_id`, `candidate_name`, `candidate_exam_status` FROM `candidate` WHERE `candidate_id` = '$chk_candidate_id'";
                $result_candi = mysqli_query($conn, $query);
                if(!$result_candi) {
                    die($query);
                }

                if(mysqli_num_rows($result_candi) != 0) {
                    $row = mysqli_fetch_array($result_candi, MYSQLI_ASSOC);
                    if($row['candidate_exam_status'] == 5) {
                        ?>
                            <script>window.location.href = "paper-sumbitted"</script>
                        <?php
                    }
                    else {
                        $candidate_name = $row['candidate_name'];
                        mysqli_free_result($result_candi);

                        $query = "SELECT `exam_code`, `exam_name`, `exam_password` FROM `exam` WHERE `is_active` = 1 ORDER BY `added_on` DESC";
                        $result = mysqli_query($conn, $query);
                        if(!$result) {
                            die($query);
                        }

                        if(mysqli_num_rows($result) != 0) {
                            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                            $exam_code = $row['exam_code'];
                            $exam_name = $row['exam_name'];
                            $exam_password = $row['exam_password'];
                            if($exam_code == $chk_exam_code && $chk_exam_password == $exam_password) {
                                $_SESSION['candidate_id'] = $chk_candidate_id;
                                $_SESSION['candidate_name'] = $candidate_name;
                                $_SESSION['exam_code'] = $chk_exam_code;
                                $_SESSION['exam_name'] = $exam_name;
                                $_SESSION['serial'] = 1;
                        ?>
                                <script>window.location.href = "check-details"</script>
                        <?php
                            }
                            else {
                                echo "<script>alert(\"Invalid Exam Code or Password !!!\");</script>";
                                echo "<script>window.location.href = \"login\"</script>";
                            }
                        }

                        else {
                            echo "<script>alert(\"Invalid Exam Code or Password !!!\");</script>";
                            echo "<script>window.location.href = \"login\"</script>";
                        }
                    }
                }

                else {
                    echo "<script>alert(\"Invalid Candidate Registration Number\");</script>";
                    echo "<script>window.location.href = \"login\"</script>";
                }
            }
            else {
                echo "<script>alert(\"* * * The Website is CSRF Protected * * *\");</script>";
                echo "<script>window.location.href = \"login\"</script>";
            }
        }
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <meta name="author" content="Pankajsree Das">

        <?= $head ?>
        <link rel="stylesheet" href="assets/css/form.css" />

    </head>
    <style>

        main {
            padding-top: 4rem;
        }

        form {
            max-width: 750px;
            margin: 0 auto;
        }

        .link-button {
            letter-spacing: 5px;
        }

        #captcha-refresh {
            margin-left: 0.5rem;
            color: #800000;
        }

    </style>
    <body>
        <header>
            <div id="header-top" class="container-fluid">
                <img class="d-inline-block" src="<?= __ROOT__ ?>/images/logo/header.png" alt="">
        </header>
        <main>
            <div class="container">
                <h1 class="mid-line"><span class="text">Candidate Login</span></h1>
                <form id="form-login" action="" method="post">
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
                    <div class="row">
                        <div class="col-4 label-b">Registration number&nbsp;: </div>
                        <div class="col-8"><input type="text" id="candidate_id" name="candidate_id" value="" placeholder="Enter your registration number" required /></div>
                    </div>
                    <div class="row">
                        <div class="col-4 label-b">Exam Code&nbsp;: </div>
                        <div class="col-8"><input type="text" id="exam_code" name="exam_code" value="" placeholder="Enter Exam Code" required /></div>
                    </div>
                    <div class="row">
                        <div class="col-4 label-b">Exam password&nbsp;: </div>
                        <div class="col-8"><input type="password" id="exam_password" name="exam_password" value="" placeholder="Enter exam password here" required /></div>
                    </div>
                    <div class="row">
                        <div class="col-4 text-center" >
                            <img id="img" class="d-inline" height="35" width="90" src="helpers/captcha.php" />
                            <a id="captcha-refresh" href="javascript:void(0);"><i class="fas fa-sync-alt"></i></a>
                        </div>
                        <div class="col-8">
                            <input type="text" class="tbl-col" placeholder="Enter Captcha Here" id="captcha" name="captcha" required />
                        </div>
                    </div>
                    <div class="row b-b-theme-normal pad-btm-1">
                        <div class="col-12">
                            <input type="submit" class="d-inline-block link-button float-right" name="submit" value="Login" />
                        </div>
                    </div>
                </form>
            </div>
        </main>

        <?= $script ?>
        <script>
            $(document).ready(function() {
                $("#captcha-refresh").click(function() {
                    $("#img").attr("src", "helpers/captcha.php?" + Math.random());
                });
            });
        </script>

    </body>
</html>
