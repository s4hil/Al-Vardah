<?php
	// Custom fetch by month

	include 'config.php';
	include '../../loginCheck.php';
	header('Access-Control-Allow-Origin');
	$data = json_decode(file_get_contents("php://input"), true);

	$month = $data['month'];
	$user_id = $_SESSION['userID'];
	$year = date('Y');
	$sql = "SELECT * FROM `dairy_records` WHERE `year` = '$year' AND `month` = '$month' AND `user_id` = '$user_id' ORDER BY `date` ASC";
	$res = mysqli_query($conn, $sql);
	$response = array();

	while($row = mysqli_fetch_array($res)){
		$response[] = $row;
	}
	echo json_encode($response);
?>