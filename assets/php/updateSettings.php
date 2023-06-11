<?php
	include 'config.php';
	include '../../loginCheck.php';
	header('Access-Control-Allow-Origin');
	$data = json_decode(file_get_contents("php://input"), true);

	$user_id = $_SESSION['userID'];
	$price = $data['newPrice'];
	$chatID = $data['chatID'];
	$token = $data['token'];

	$sql = "UPDATE `tracker_config` SET `LPV`='$price', `telegram_chat_id` = '$chatID',`telegram_auth_token` = '$token' WHERE `user_id` = '$user_id'";
	$res = mysqli_query($conn, $sql);
	if ($res) {
		$response = "Updated!";
	}
	else {
		$response = "Failed To Update!";
	}
	echo json_encode($response);

?>