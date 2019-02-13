<?php
    session_start();
    require_once("../check-session.php");
    require_once("../../common/common.php");
    require_once("../../config/db-config.php");
    require_once("../../helpers/token.php");


	if(isset($_POST['e_code']) && Token::check($_POST['token'])) {

        $e_code = mysqli_real_escape_string($conn, $_POST['e_code']);

        $query = "SELECT `exam_name` FROM `exam` WHERE `exam_code` = '$e_code'";
        $result = mysqli_query($conn, $query);
        if(!$result) {
            die($query);
        }

        $row_count = mysqli_num_rows($result);
        if($row_count != 0) {
            ?>
        <script>alert("Exam Code Already Exists !!!")</script>
        <?php
            header("refresh: 0.1; url=add-details");
        }
        else {
            $e_name = mysqli_real_escape_string($conn, $_POST['e_name']);
            $e_password = mysqli_real_escape_string($conn, $_POST['e_password']);
            $sec_count = $_POST['sec_count'];

    		$query = "INSERT INTO `exam` (`exam_code`, `exam_name`, `sec_count`, `exam_password`) VALUES ('$e_code', '$e_name', '$sec_count', '$e_password')";
    		$result= mysqli_query($conn, $query);
    		if(!$result) {
    			// die("Query Failed !!!");
    			die($query);
    		}

            ?>
            <script>
                alert("Exam Details Added Successfully");
                function redirect() {
                    window.location = "../dashboard";
                }
                setTimeout(redirect(), 5000);
            </script>
            <?php
        }
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
    </head>
    <body>
        <?= $header ?>
        <main>
            <div class="container">
                <h1 class="mid-line"><span class="text">Add Exam Details</span></h1>
                <form id="add-form" method="post" action="add-details">
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
                    <input type="hidden" value="" name="updated_col" id="updated-col" />

                    <div class="row">
                        <div class="col-4 label-b">Exam Code&nbsp;: </div>
                        <div class="col-8">
                            <input type="text" id="e_code" name="e_code" class="tbl-col" placeholder="Exam Code" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 label-b">Exam Name&nbsp;: </div>
                        <div class="col-8">
                            <input type="text" id="e_name" name="e_name" class="tbl-col" placeholder="Exam Name" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 label-b">Exam Password&nbsp;: </div>
                        <div class="col-8">
                            <input type="text" id="e_password" name="e_password" class="tbl-col" placeholder="Exam Password" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 label-b">Number of Sections&nbsp;: </div>
                        <div class="col-8">
                            <select id="sec_count" name="sec_count" class="tbl-col" >
                                <option value="1" selected hidden>Number of Sections</option>
                                <option value="1">1</option>
                                <!-- <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option> -->
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-right">
                            <input type="submit" class="link-button" value="Add Exam" />
                        </div>
                    </div>
                </form>
            </div>
        </main>

        <?= $script ?>
    </body>
</html>
