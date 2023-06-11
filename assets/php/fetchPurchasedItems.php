<?php
	include 'config.php';
	include '../../loginCheck.php';
	header('Access-Control-Allow-Origin');
	$data = json_decode(file_get_contents("php://input"), true);

	$month = $data['month'];
	$year = date('Y');
	$user_id = $_SESSION['userID'];

	$response = array();
	$sql = "SELECT * FROM `purchased_items` WHERE `month` = '$month' AND `user_id` = '$user_id' AND `year` = '$year' ORDER BY `date` ASC";
	$res = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_array($res)) {
		$response[] = $row;
	}
	echo json_encode($response);
?>