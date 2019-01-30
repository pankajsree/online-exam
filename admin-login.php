<?php
    session_start();
    require("common/common.php");
    require_once("config/db-config.php");
    require_once("common/token.php");

    if(isset($_SESSION['uid'])) {
        header("Location: profile/view-profile");
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
                $uemail = mysqli_real_escape_string($conn, $_POST['email']);
                $password = mysqli_real_escape_string($conn, $_POST['password']);
                $password_hash = password_hash($password, PASSWORD_DEFAULT);

                $query = "SELECT * FROM login WHERE email='" . $uemail . "' AND email_status='verified'";
                $res = mysqli_query($conn, $query);

                if(!$res) {
                    die($query);
                }

                if(mysqli_num_rows($res) != 0) {
                    $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
                    if(password_verify($password, $row['password'])) {

                        $_SESSION['uid'] = $row['id'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['role_id'] = $row['role_id'];

                        switch ($_SESSION['role_id']) {
                            case 1:
                                $role = 'staff';
                                break;

                            case 2:
                                $role = 'faculty';
                                break;

                            default:
                                $role = 'administration';
                                break;
                        }

                        $query = "SELECT `f_name` FROM " . $role . " WHERE `user_id` = " . $row['id'];
                        $result = mysqli_query($conn, $query);
                        $row_fn = mysqli_fetch_assoc($result);
                        $_SESSION['f_name'] = $row_fn['f_name'];

                        if($_SESSION['role_id'] == 8 || $_SESSION['role_id'] == 1 || $_SESSION['role_id'] == 2) {
                            $query = "SELECT `dept_code` FROM " . $role . " WHERE user_id='" . $row['id'] . "'";
                            $res = mysqli_query($conn, $query);
                            if(!$res) {
                                die($query);
                            }
                            $row_dept = mysqli_fetch_assoc($res);
                            $_SESSION['dept_code'] = $row_dept['dept_code'];

                            $query = "SELECT `url` FROM `departments` WHERE `dept_code`=" . $row_dept['dept_code'];
                            $res = mysqli_query($conn, $query);
                            if(!$res) {
                                die($query);
                            }
                            $row_dept = mysqli_fetch_assoc($res);
                            $_SESSION['dept_url'] = $row_dept['url'];
                        }
                ?>
                        <script>window.location.href = "profile/view-profile"</script>
                <?php
                    }
                    else {
                        echo "<script>alert(\"Password Mismatch, Try Again !!!\");</script>";
                        echo "<script>window.location.href = \"login\"</script>";
                    }
                }

                else {
                    echo "<script>alert(\"Password Mismatch, Try Again !!!\");</script>";
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
        <title>NIT Agartala</title>
        <meta name="author" content="Pankajsree Das">
        <?= $head ?>
        <link rel="stylesheet" href="assets/css/form.css" />
    </head>
    <body>

        <main>
            <div class="container">
                <form id="form-login" action="login.php" method="post">
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
                    <div class="row">
                        <div class="col-md-4"><label for="email">Registered Email&nbsp;ID</label></div>
                        <div class="col-md-8"><input type="email" id="email" name="email" value="" placeholder="Enter Your Registered Email ID" required /></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><label for="password">Password</label></div>
                        <div class="col-md-8"><input type="password" id="password" name="password" value="" placeholder="Enter Valid Password" required /></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4" ><label for="captcha">Captcha</label></div>
                        <div class="col-md-3 text-center" >
                            <img id="img" class="d-inline" height="35" width="90" src="common/captcha.php" />
                            <a id="captcha-refresh" href="javascript:void(0);"><i class="fas fa-sync-alt"></i></a>
                        </div>
                        <div class="col-md-5">
                            <input type="text" class="tbl-col" placeholder="Enter Captcha Here" id="captcha" name="captcha" required />
                        </div>
                    </div>
                    <div class="row b-b-theme-normal pad-btm-1">
                        <div class="col-12">
                            <input type="submit" class="link-button d-inline-block float-right" name="submit" value="Login" />
                        </div>
                    </div>
                    <div class="pad-left-1 underline-links">
                        <a class="text-bold" href="profile/forgot-password">Forgot your Password?</a>
                    </div>
                </form>
            </div>
        </main>

        <?= $script ?>
        <script>
            $(document).ready(function() {
                $("#captcha-refresh").click(function() {
                    $("#img").attr("src", "common/captcha.php?" + Math.random());
                });
            });
        </script>

    </body>
</html>
