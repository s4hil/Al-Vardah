<?php
	include 'config.php';
	include '../../loginCheck.php';
	header('Access-Control-Allow-Origin');
	$data = json_decode(file_get_contents("php://input"), true);
	
	$user_id = $_SESSION['userID'];

	$date = $data['date'];

	$checkDuplicate = "SELECT * FROM `dairy_records` WHERE `date` = '$date' AND `user_id` = '$user_id'";
	$query = mysqli_query($conn, $checkDuplicate);

	$record = mysqli_fetch_array($query);

	if ($record['date'] == $date) {
		$response = "Todays Record Already Exists!";
	}
	else {
		$dateArray = explode('/', $date);
		$month = $dateArray[1];
		$year = $dateArray[2];

		$quantity = $data['quantity'];
		$sql = "INSERT INTO `dairy_records` (`date`, `month`, `year`,`quantity`, `user_id`) VALUES ('$date', '$month','$year' ,'$quantity', '$user_id')";
		$res = mysqli_query($conn, $sql);
		if ($res) {
			$response = "Record Added!";
		}
		else {
			$response = "Failed To Add!";
		}

	}
	echo json_encode($response);
?>