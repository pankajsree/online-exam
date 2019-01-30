<?php

	require_once("../config/db-config.php");

	$newPW = mysqli_real_escape_string($conn, $_POST['new-password']);
    $admin_id = mysqli_real_escape_string($conn, $_POST['user-id']);
    $password_hash = password_hash($newPW, PASSWORD_DEFAULT);

    $query = "UPDATE `admin` SET `password` = '$password_hash' WHERE `admin_id` = $admin_id";
	$result = mysqli_query($conn,$query);
	if(!$result)
	{
		die("Query Failed !!!!" . mysqli_error($conn));
	}

?>
