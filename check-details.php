<?php
    session_start();
    require("common/common.php");
    require_once("config/db-config.php");
    require_once("helpers/token.php");
    require_once("helpers/check-login.php");

    $candidate_id = $_SESSION['candidate_id'];

    if(isset($_POST['agreement'])) {
        $agreement = $_POST['agreement'];
        if($agreement == "1") {
            $query = "UPDATE `candidate` SET `details_agreement` = 1 WHERE `candidate_id` = '$candidate_id'";
            $result = mysqli_query($conn, $query);
            if(!$result) {
                die($query);
            }
            echo "<script>alert(\"We will contact you . . . Proceed to exam!\");</script>";
        }
        echo "<script>window.location.href = \"instructions\"</script>";
    }
    else {
        $query = "SELECT `candidate_care_of` FROM `candidate` WHERE `candidate_id` = '$candidate_id'";
        $result = mysqli_query($conn, $query);
        if(!$result) {
            die($query);
        }
        $row = mysqli_fetch_assoc($result);
        $care_of = $row['candidate_care_of'];
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Check Details</title>
        <meta name="author" content="Pankajsree Das">

        <?= $head ?>
        <!-- <link rel="stylesheet" href="assets/css/form.css" /> -->

    </head>
    <style>

        main {
            padding-top: 5rem;
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

        table {
            margin: 0 auto;
        }

        td {
            padding: 0.5rem 2rem;;
            font-size: 1.1rem;
        }

        input, label {
            cursor: pointer;
        }

    </style>
    <body>
        <header>
            <div id="header-top" class="container-fluid">
                <img class="d-inline-block" src="<?= __ROOT__ ?>/images/logo/header.png" alt="">
        </header>
        <main>
            <div class="container">
                <h1 class="mid-line"><span class="text">Check Details</span></h1>
                <form id="form-login" action="" method="post">
                    <table>
                        <tbody>
                            <tr>
                                <td>Candidate Name</td>
                                <td><?= $_SESSION['candidate_name'] ?></td>
                            </tr>
                            <tr>
                                <td>Candidate Care-of</td>
                                <td><?= $care_of ?></td>
                            </tr>
                            <tr>
                                <td>Are the above details correct ??</td>
                                <td>
                                    <input type="radio" id="agreement-yes" name="agreement" value="0" checked />&nbsp;<label for="agreement-yes">YES</label>&nbsp;&nbsp;&nbsp;
                                    <input type="radio" id="agreement-no" name="agreement" value="1" />&nbsp;<label for="agreement-no">NO</label>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="row mar-top-2">
                        <div class="col-12 text-center">
                            <input type="submit" class="d-inline-block link-button" name="submit" value="Proceed" />
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
