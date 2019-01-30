<?php
    require_once("../config/db-config.php");
    require_once("../common/common.php");

    if(isset($_GET['user_id']) && isset($_GET['activation_code'])) {
        $admin_id = $_GET['user_id'];
        $query = "SELECT `activation_code` FROM `admin` WHERE `admin_id`= $admin_id";
        $result = mysqli_query($conn, $query);
        if(!$result) {
            die("Query Failed !!!");
        }
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $activation_code = $row['activation_code'];
        $url_activation_code = $_GET['activation_code'];
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
                                <h1><span class="b-b-theme-thick-center">Reset Password</span></h1>
                                <form id="update-password-form" method="post" action="../action/update-password.php">
                                    <input type="hidden" id="user-id" name="user-id" value="<?= $admin_id ?>" />
                                    <div class="row">
                                        <div class="col-4 col-md-3">New Password : </div>
                                        <div class="col-8 col-md-9">
                                            <input type="password" id="new-password" name="new-password" class="tbl-col" placeholder="New Password"required />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4 col-md-3">Confirm Password : </div>
                                        <div class="col-8 col-md-9">
                                            <input type="password" id="confirm-password" name="confirm-password" class="tbl-col" placeholder="Confirm Password" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            <input type="submit" id="password-submit" value="Update Password" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </main>

                        <?= $script ?>
                        <script>
                			$(document).ready(function() {
                				$('#update-password-form').submit(function(event) {

                					event.preventDefault();

                                    var newPW = $("#new-password").val();
                                    var confirmPW = $("#confirm-password").val();

                                    var strcmp = newPW.localeCompare(confirmPW);

                                    if(strcmp != 0) {
                                        // event.preventDefault();
                                        $("#new-password").val("");
                                        $("#confirm-password").val("");
                                        alert("Passwords don't match !!!");
                                    }
                                    else {
                                        var form = $(this);
                    					var data = form.serialize();

                    					$.ajax({
                    						url: '../action/update-password.php',
                    						type: 'post',
                    						data: data,
                    						success: function(result) {
                    							alert("Password changed Successfully. Try logging in to your account");
                                                window.setTimeout(function () {
                                                    location.href = "<?= __ROOT__ ?>/admin/login";
                                                }, 500);
                    						},
                    						error: function(){
                    							alert("Password couldn't be reset !!! Please try again . . .");
                    						}
                    					});
                                    }
                				});
                			});
                		</script>
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
