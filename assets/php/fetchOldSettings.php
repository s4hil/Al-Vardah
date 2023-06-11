<?php
	include 'config.php';
	include '../../loginCheck.php';
	header('Access-Control-Allow-Origin');

	$user_id = $_SESSION['userID'];
	
	$sql = "SELECT * FROM `tracker_config` WHERE `user_id` = '$user_id'";
	$res = mysqli_query($conn, $sql);
	if (mysqli_num_rows($res) > 0) {

		$sql = "SELECT * FROM `tracker_config` WHERE `user_id` = '$user_id' LIMIT 1";
		$res = mysqli_query($conn, $sql);
			
		$row = mysqli_fetch_array($res);
		$response['res'] = 1;
		$response['LPV'] = $row['LPV'];
		$response['chatID'] = $row['telegram_chat_id'];
		$response['token'] = $row['telegram_auth_token'];
	}
	else {
		$response['res'] = 0;
	}

	echo json_encode($response);

?>