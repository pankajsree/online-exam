<?php
    function updateQues($serial, $questions) {
        ?>
        <div id="ques_sl_<?= $serial ?>" class="ques_sl">Question <?= $serial ?>:</div>
        <div id="ques_<?= $serial ?>" class="ques">
            <?= $questions[$serial - 1]['ques'] ?>
        </div>
        <?php
            if($questions[$serial - 1]['image'] != "") {
                ?>
            <p>
                <img id="ques-img_<?= $serial ?>" src="<?= __ROOT__ ?>/exam-img/<?= $questions[$serial - 1]['image'] ?>" alt="" />
            </p>
        <?php
            }
        ?>
        <div class="options-container">
            <input type="radio" id="opt_0_<?= $serial ?>" name="option_<?= $serial ?>" value="0" class="d-none" />
            <input type="radio" id="opt_1_<?= $serial ?>" name="option_<?= $serial ?>" value="1" /><label for="opt_1_<?= $serial ?>">&nbsp;<?= $questions[$serial - 1]['opt_1'] ?></label><br />
            <input type="radio" id="opt_2_<?= $serial ?>" name="option_<?= $serial ?>" value="2" /><label for="opt_2_<?= $serial ?>">&nbsp;<?= $questions[$serial - 1]['opt_2'] ?></label><br />
            <input type="radio" id="opt_3_<?= $serial ?>" name="option_<?= $serial ?>" value="3" /><label for="opt_3_<?= $serial ?>">&nbsp;<?= $questions[$serial - 1]['opt_3'] ?></label><br />
            <input type="radio" id="opt_4_<?= $serial ?>" name="option_<?= $serial ?>" value="4" /><label for="opt_4_<?= $serial ?>">&nbsp;<?= $questions[$serial - 1]['opt_4'] ?></label>
            <input type="radio" id="opt_5_<?= $serial ?>" name="option_<?= $serial ?>" value="5" class="d-none" />
            <input type="radio" id="opt_6_<?= $serial ?>" name="option_<?= $serial ?>" value="6" class="d-none" />
            <div class="clear-container">
                <!-- <button type="button" name="review" data-serial="<?= $serial ?>" class="review review-sl">Mark&nbsp;for&nbsp;Review</button> -->
                <!-- <button type="button" name="clear" data-serial="<?= $serial ?>" class="clear clear-sl">Clear&nbsp;Response</button> -->
            </div>
        </div>
        <?php
    }
?>
