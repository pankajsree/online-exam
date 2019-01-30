<?php
	if(!isset($_SESSION['uid'])) {
		header("Location: " . __ROOT__ . "/admin/login");
	}

	$timeout_duration = 3600;
	if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
		header("Location: " . __ROOT__ . "/admin/logout");
	}
	else{
		$_SESSION['last_activity'] = time();
	}
?>
