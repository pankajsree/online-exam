<?php
    require_once("../config/db-config.php");
    require_once("../common/common.php");

    if(isset($_GET['user_id']) && isset($_GET['activation_code'])) {
        $admin_id = $_GET['user_id'];
        $query = "SELECT `activation_code`, `email_status` FROM `admin` WHERE `admin_id`='$admin_id'";
        $result = mysqli_query($conn, $query);
        if(!$result) {
            die("Query Failed !!!");
        }
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $url_activation_code = $_GET['activation_code'];
        $activation_code = $row['activation_code'];
        $email_status = $row['email_status'];
        if(mysqli_num_rows($result) == 0) {
            http_response_code(404);
            require("../error/404.php");
            die();
        }
        else {
            if(strcmp($activation_code, $url_activation_code) != 0) {
                http_response_code(404);
                require("../error/404.php");
                die();
            }
            else {
                if(strcmp('verified', $email_status) == 0) {
                    $message = "Email Already Verified !!!";
                }
                else {
                    $query = "UPDATE `admin` SET `email_status`='verified' WHERE `admin_id`='$admin_id'";
                    $result = mysqli_query($conn, $query);
                    if(!$result) {
                        die("Query Failed !!!");
                    }
                    $message = "Email Address Verified Successfully !!!";
                }

                ?>
                <!DOCTYPE html>
                <html>
                    <head>
                        <title>Edit Profile</title>
                        <meta name="author" content="Pankajsree Das">
                        <?= $head ?>
                        <link rel="stylesheet" href="../assets/css/form.css" />
                    </head>
                    <body>

                        <main>
                            <div class="container text-center">
                                <h1><span class="b-b-theme-thick-center">Email Verification</span></h1>
                                <strong class="font-1-25"><?= $message ?></strong>
                                </br />
                                <a class="default-links" href="<?= __EMAIL_ROOT__ ?>/admin/login">Click Here</a>, to Login to your account.
                            </div>
                        </main>
                        
                        <?= $script ?>
                    </body>
                </html>

                <?php
            }
        }
	}
    else {
        http_response_code(404);
        require("../error/404.php");
        die();
    }

?>
