<?php
    session_start();
    require_once("../common/common.php");
    require_once("../config/db-config.php");


	if(isset($_POST['email'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);

        $query = "SELECT `admin_id` FROM `admin` WHERE `email` = '$email' AND `email_status` = 'verified'";
        $result = mysqli_query($conn, $query);
        if(!$result) {
            die($query);
        }
        $row_count = mysqli_num_rows($result);
        if($row_count == 0) {
            ?>
        <script>alert("Email doesn't Exist !!!")</script>
        <?php
            header("refresh: 0.1; url=forgot-password.php");
        }
        else {
            $row = mysqli_fetch_assoc($result);
            $admin_id = $row['admin_id'];
            $activation_code = md5(rand(100000, 999999));

    		$query = "UPDATE `admin` SET `activation_code` = '$activation_code' WHERE `admin_id` = $admin_id";
    		$result= mysqli_query($conn, $query);
    		if(!$result) {
    			// die("Query Failed !!!");
    			die($query);
    		}
            $base_url = __EMAIL_ROOT__ . "/admin/update-password.php?";
            $mail_body = "
                <p>Hello ADMIN !!!</p>
                <p>This is in response to your Reset Password Request. Click on the link below to Reset your Password - </p>
                <p>
                    <a href=\"" . $base_url . "user_id=" . $admin_id . "&activation_code=" . $activation_code . "\">" . $base_url . "user_id=" . $admin_id . "&activation_code=" . $activation_code . "</a>
                </p>
                <p>Technical Team<br /><b>NIT Agartala</b></p>
            ";

            require_once("../assets/phpmailer/PHPMailerAutoload.php");

            $mail = new PHPMailer;
            $mail->SMTPDebug = 0;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'daspanku033@gmail.com';
            $mail->Password = '9089589666';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = '465';
            // $mail->SMTPSecure = 'tls';
            // $mail->Port = '587';
            $mail->setFrom('daspanku@033@gmail.com', 'Technical Team');
            // $mail->addAddress('daspankajsree@gmail.com');
            $mail->AddAddress($email);
            $mail->addReplyTo('daspankajsree@gmail.com');
            $mail->WordWrap = 50;
            $mail->IsHTML(true);
            $mail->Subject = 'Password Reset';
            $mail->Body = $mail_body;
            if($mail->Send()) {
                ?>
        			<script>alert("Password Reset Link has been Sent to the Email Address provided");</script>
        		<?php
            }
            else {
                die($mail->ErrorInfo);
            }
        }
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

        <div class="container">
            <h1 class="text-center mar-btm-1"><span class="b-b-theme-thick-center">Forgot Password</span></h1>
            <div id="forgot-pw-content">
                <p class="l-s-1-5">To reset your password, enter the email address you use to login to NIT Agartala. A link will be sent to the email address which will let you reset your password.</p>
                <form method="post" action="forgot-password.php">
                    <input type="email" id="email" name="email" class="tbl-col" placeholder="Enter your Email Address" required />
                    <div class="row">
                        <div class="col-12 text-right">
                            <input type="submit" value="Submit" />
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <?= $script ?>
    </body>
</html>
