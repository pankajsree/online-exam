<?php
    session_start();
    require_once("check-session.php");
    require_once("../common/common.php");
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
    <style media="screen">
        body {
            padding-top: 0;
        }
        main {
            padding-top: 3rem;
        }
    </style>
    <body>
        <?= $header ?>
        <main>
            <div class="btn-container container">
                <div class="row justify-content-center">
                    <div class="col-customed col-12 col-sm-6 col-lg-4">
                        <a href="add-admin">Add Admin</a>
                    </div>
                    <div class="col-customed col-12 col-sm-6 col-lg-4">
                        <a href="change-password">Change Password</a>
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
                        <a href="exam/arrange-responses">Arrange Responses</a>
                    </div>
                    <div class="col-customed col-12 col-sm-6 col-lg-4">
                        <a href="exam/calculate-result">Calculate Result</a>
                    </div>
                    <div class="col-customed col-12 col-sm-6 col-lg-4">
                        <a href="tcpdf/reports/response" target="_blank">Candidate Responses</a>
                    </div>
                    <div class="col-customed col-12 col-sm-6 col-lg-4">
                        <a href="tcpdf/reports/result" target="_blank">View Result</a>
                    </div>
                    <div class="col-customed col-12 col-sm-6 col-lg-4">
                        <a href="logout">Logout</a>
                    </div>
                </div>
            </div>
        </main>
        <?= $footer ?>
        <?= $script ?>
    </body>
</html>
