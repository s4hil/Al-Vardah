<?php
	include 'config.php';
	include '../../loginCheck.php';
	header('Access-Control-Allow-Origin');
	$data = json_decode(file_get_contents("php://input"), true);

	$month = $data['month'];


	function getVal($month, $date)
	{
		global $conn;

		$user_id = $_SESSION['userID'];

		$dbDate = $date."/".$month."/2021";
		$sql = "SELECT * FROM `dairy_records` WHERE `month` = '$month' AND `date` = '$dbDate' AND `user_id` = '$user_id' LIMIT 1";
		$res = mysqli_query($conn, $sql);
		if ($res) {
			$row = mysqli_fetch_array($res);
			$val = $row['quantity'];
			return $val;
		}
	}

	$response = array();

	$response[0] = getVal($month,5);
	$response[1] = getVal($month,10);
	$response[2] = getVal($month,15);
	$response[3] = getVal($month,20);
	$response[4] = getVal($month,25);
	$response[5] = getVal($month,30);

	echo json_encode($response);

?>
