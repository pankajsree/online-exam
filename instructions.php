<?php
    require_once("common/common.php");
    require_once("config/db-config.php");

    $query = "";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Instructions</title>
        <?= $head ?>
        <link rel="stylesheet" href="assets/css/instructions.css">
    </head>
    <body>
        <header>
            <div id="header-top" class="container-fluid">
                <img class="d-inline-block" src="<?= __ROOT__ ?>/images/logo/header.png" alt="">
        </header>
        <main>
            <div class="container">
                <h1 class="mid-line"><span class="text">General Instructions</span></h1></h1>
                <b>Please read the instructions carefully</b><br /><br />
                <h5>General Instructions:</h5>
                <ol>
                    <li>Total duration of this Exam is 60 min.</li>
                    <li>The clock will be set at the server. The countdown timer in the top right corner of screen will display the remaining time available for you to complete the examination. When the timer reaches zero, the examination will end by itself. You will not be required to end or submit your examination.</li>
                    <li>The Questions Palette displayed on the right side of screen will show the status of each question using one of the following symbols:
                        <ol class="ques-palette-inst">
                            <li>
                                <div class="d-flex align-items-center"><div class="ques-sl-btn"></div>You have not visited the question yet.</div>
                            </li>
                            <li>
                                <div class="d-flex align-items-center"><div class="ques-sl-btn sl-not-answered"></div>You have not answered the question.</div>
                            </li>
                            <li>
                                <div class="d-flex align-items-center"><div class="ques-sl-btn sl-answered"></div>You have answered the question.</div>
                            </li>
                            <li>
                                <div class="d-flex align-items-center"><div class="ques-sl-btn sl-marked-re"></div>You have NOT answered the question, but have marked the question for review.</div>
                            </li>
                            <li>
                                <div class="d-flex align-items-center"><div class="ques-sl-btn sl-ans-marked-re"></div>The question(s) "Answered and Marked for Review" will be considered for evalution.</div>
                            </li>
                        </ol>
                    </li>
                </ol>
                <h5>Navigating to a Question:</h5>
                <ol start="4">
                    <li>To answer a question, do the following:
                        <ol type="a">
                            <li>Click on the question number in the Question Palette at the right of your screen to go to that numbered question directly. Note that using this option does NOT save your answer to the current question.</li>
                            <li>Click on <strong>Save & Next</strong> to save your answer for the current question and then go to the next question.</li>
                            <li>Click on <strong>Mark for Review & Next</strong> to save your answer for the current question, mark it for review, and then go to the next question.</li>
                        </ol>
                    </li>
                </ol>
                <h5>Answering a Question:</h5>
                <ol start="5">
                    <li>Procedure for answering a multiple choice type question:
                        <ol type="a">
                            <li>To select you answer, click on the button of one of the options.</li>
                            <li>To deselect your chosen answer, click on the button of the chosen option again or click on the <strong>Clear Response</strong> button.</li>
                            <li>To change your chosen answer, click on the button of another option</li>
                            <li>To save your answer, you MUST click on the Save & Next button.</li>
                            <li>To mark the question for review, click on the Mark for Review & Next button.</li>
                        </ol>
                    </li>
                    <li>To change your answer to a question that has already been answered, first select that question for answering and then follow the procedure for answering that type of question.</li>
                </ol>

                <form action="section-intro" method="post">
                    <input type="checkbox" name="agree" id="agree" value="" />
                    <label for="agree">&nbsp;&nbsp;I have read and understood the instructions. All computer hardware allotted to me are in proper working condition. I declare that I am not in possession of / not wearing / not carrying any prohibited gadget like mobile phone, bluetooth devices etc. /any prohibited material with me into the Examination Hall.I agree that in case of not adhering to the instructions, I shall be liable to be debarred from this Test and/or to disciplinary action, which may include ban from future Tests / Examinations</label>
                    <br />
                    <div class="row">
                        <div class="col-12 text-right">
                            <input type="submit" id="submit-btn" class="link-button" name="submit" value="Proceed" disabled />
                        </div>
                    </div>
                </form>

            </div>
        </main>

        <?= $script ?>
        <script>
            $(document).ready(function() {
                $("#agree").change(function() {
                    if($(this).is(':checked')) {
                        $("#submit-btn").prop("disabled", false);
                    }
                    else {
                        $("#submit-btn").prop("disabled", true);
                    }
                });
            });
        </script>

    </body>
</html>
