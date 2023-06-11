<?php
	include 'config.php';
	include '../../loginCheck.php';
	header('Access-Control-Allow-Origin');
	$data = json_decode(file_get_contents("php://input"), true);

	$user_id = $_SESSION['userID'];
	$price = $data['price'];
	$chatID = $data['chatID'];
	$token = $data['token'];

	$sql = "INSERT INTO `tracker_config` (`LPV`, `telegram_chat_id`, `telegram_auth_token`, `user_id`) 
			VALUES ('$price', '$chatID', '$token', '$user_id')";
	$res = mysqli_query($conn, $sql);
	if ($res) {
		$response = "Settings Added!";
	}
	else {
		$response = "Failed To Add Settings!";
	}

	echo json_encode($response);
?>