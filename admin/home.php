<?php
    session_start();
    require_once("../common/common.php");
    require_once("session-timeout.php");
    require_once("../config/db-config.php");
    require_once("../helpers/token.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Add Admin</title>
        <meta name="author" content="Pankajsree Das">
        <?= $head ?>
        <link rel='stylesheet' href="../assets/css/home.css" />
    </head>
    <body>
        <div class="btn-container container">
            <div class="row justify-content-center">
                <div class="col-customed col-12 col-sm-6 col-lg-4">
                    <a href="add-admin">Add Admin</a>
                </div>
                <div class="col-customed col-12 col-sm-6 col-lg-4">
                    <a href="exam/add-details">Add Exam Details</a>
                </div>
                <div class="col-customed col-12 col-sm-6 col-lg-4">
                    <a href="exam/section-details">Add Section Details</a>
                </div>
                <div class="col-customed col-12 col-sm-6 col-lg-4">
                    <a href="exam/upload-ques">Upload Questions</a>
                </div>
                <div class="col-customed col-12 col-sm-6 col-lg-4">
                    <a href="exam/upload-answer">Upload Answer Key</a>
                </div>
                <div class="col-customed col-12 col-sm-6 col-lg-4">
                    <a href="exam/add-candidates">Add Candidates</a>
                </div>
                <div class="col-customed col-12 col-sm-6 col-lg-4">
                    <a href="exam/change-status">Change Exam Status</a>
                </div>
                <div class="col-customed col-12 col-sm-6 col-lg-4">
                    <a href="exam/view-result">View Result</a>
                </div>
                <div class="col-customed col-12 col-sm-6 col-lg-4">
                    <a href="exam/list">Exam List</a>
                </div>
            </div>

        </div>
        <?= $script ?>
    </body>
</html>
