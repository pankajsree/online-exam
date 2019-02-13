<?php
    session_start();
    require_once("check-session.php");
    require_once("../common/common.php");
    require_once("../config/db-config.php");
    require_once("../helpers/token.php");


	if(isset($_POST['email']) && Token::check($_POST['token'])) {

        function random_password() {
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+?";
            $rand_password = substr( str_shuffle( $chars ), 0, 8 );
            return $rand_password;
        }

        $query = "SELECT `admin_id` FROM `admin` WHERE `email` = '" . mysqli_real_escape_string($conn, $_POST['email']) . "'";
        $result = mysqli_query($conn, $query);
        if(!$result) {
            die($query);
        }
        $row_count = mysqli_num_rows($result);
        if($row_count != 0) {
            ?>
        <script>alert("Email Already Exists !!!")</script>
        <?php
            header("refresh: 0.1; url=add-user.php");
        }
        else {
            $email = mysqli_real_escape_string($conn, $_POST['email']);
    		$password = random_password();
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $activation_code = md5(rand(100000, 999999));

    		$query = "INSERT INTO admin (`email`, `password`, `activation_code`, `email_status`) VALUES('$email', '$password_hash', '$activation_code', 'not verified')";
    		$result= mysqli_query($conn, $query);
    		if(!$result) {
    			// die("Query Failed !!!");
    			die($query);
    		}

            $query = "SELECT `admin_id` FROM `admin` WHERE `email`='$email'";
            $result= mysqli_query($conn, $query);
            if(!$result) {
    			die("USER_ID Query Failed !!!");
    			// die($query);
    		}
            $row = mysqli_fetch_assoc($result);
            $new_uid = $row['admin_id'];

            $base_url = __EMAIL_ROOT__ . "/admin/verify-user.php?";
            $mail_body = "
                <p>Hello ADMIN !!!</p>
                <p>Your Password is <b>" . $password . "</b>. This work only after your Email Verification.</p>
                <p>
                    To verify your Email ID, Open the link below - <br />
                    <a href=\"" . $base_url . "user_id=" . $new_uid . "&activation_code=" . $activation_code . "\">" . $base_url . "user_id=" . $new_uid . "&activation_code=" . $activation_code . "</a>
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
            $mail->setFrom('daspanku033@gmail.com', 'Technical Team');
            // $mail->addAddress('daspankajsree@gmail.com');
            $mail->AddAddress($email);
            $mail->addReplyTo('daspankajsree@gmail.com');
            $mail->WordWrap = 50;
            $mail->IsHTML(true);
            $mail->Subject = 'Email Verification';
            $mail->Body = $mail_body;
            if($mail->Send()) {
                ?>
        			<script>alert("User Added Successfully, Email Verification Link Sent to the User Email");</script>
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
        <title>Add Admin</title>
        <meta name="author" content="Pankajsree Das">
        <?= $head ?>
        <link rel="stylesheet" href="../assets/css/admin.css" />
        <link rel="stylesheet" href="../assets/css/form.css" />
    </head>
    <body>
        <?= $header ?>
        <main>
            <div class="container">
                <h1 class="mid-line"><span class="text">Add Admin</span></h1>
                <form id="add-form" method="post" action="add-admin.php">
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
                    <div class="row">
                        <div class="col-12">
                            <input type="email" id="email" name="email" class="tbl-col" placeholder="Email ID" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-right">
                            <input type="submit" class="link-button" value="Add Admin" />
                        </div>
                    </div>
                </form>
            </div>
        </main>

        <?= $script ?>
    </body>
</html>
