<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/online-exam/common/common.php");

	if(!isset($_SESSION['candidate_id'])) {
		header("Location: " . __ROOT__ . "/login");
	}
?>
