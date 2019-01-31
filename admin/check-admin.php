<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/common/common.php");

	if(!isset($_SESSION['email'])) {
		header("Location: " . __ROOT__ . "admin/");
	}

	$timeout_duration = 7200;
	if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
		header("Location: " . __ROOT__ . "admin/logout");
	}
	else{
		$_SESSION['last_activity'] = time();
	}
?>
