<?php
	define('__MY_ROOT__', "/online-exam");

	if(!isset($_SESSION['admin_id'])) {
		header("Location: " . __MY_ROOT__ . "/admin/login");
	}

	$timeout_duration = 3600;
	if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
		header("Location: " . __MY_ROOT__ . "/admin/logout");
	}
	else{
		$_SESSION['last_activity'] = time();
	}
?>
