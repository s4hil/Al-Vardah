<?php
	include 'config.php';
	include '../../loginCheck.php';
	header('Access-Control-Allow-Origin');
	$data = json_decode(file_get_contents("php://input"), true);

	$id = $data['delID'];
	$user_id = $_SESSION['userID'];
	$sql = "DELETE FROM `dairy_records` WHERE `id` = '$id' AND `user_id` = '$user_id'";
	$res = mysqli_query($conn, $sql);
	if ($res) {
		$response = "Deleted!";
	}
	else {
		$response = "Failed To Delete!";
	}
	echo json_encode($response);
?>
