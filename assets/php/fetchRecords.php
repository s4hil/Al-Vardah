<?php
	include 'config.php';
	include "../../loginCheck.php";
	header('Access-Control-Allow-Origin');
	$data = json_decode(file_get_contents("php://input"), true);

	$date = $data['date'];

	$dateArray = explode('/', $date);

	$month = $dateArray[1];
	$year = $dateArray[2];

	$response = array();
	$user_id = $_SESSION['userID'];
	$sql = "SELECT * FROM `dairy_records` WHERE `month` = '$month' AND `year` = '$year' AND `user_id` = '$user_id'";
	$res = mysqli_query($conn, $sql);

	while ($row = mysqli_fetch_array($res)) {
		$response[] = $row;
	}
	echo json_encode($response);
?>