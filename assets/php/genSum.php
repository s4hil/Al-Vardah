<?php
	include 'config.php';
	include '../../loginCheck.php';
	header('Access-Control-Allow-Origin');
	$data = json_decode(file_get_contents("php://input"), true);

	$month = $data['month'];
	$totalLitres = 0;
	$user_id = $_SESSION['userID'];
	$currentYear = date('Y');

	$sql = "SELECT * FROM `dairy_records` WHERE `month` = '$month' AND `user_id` = '1' AND `year` = '$currentYear'";
	$res = mysqli_query($conn, $sql);
	if ($res) {
		if (mysqli_num_rows($res) == 0) {
				$response['tbl_err'] = 1;
		}
		else {
			while ($row = mysqli_fetch_array($res)) {
				$totalLitres += $row['quantity'];
				$fullDate = $row['date'];
			}

			$fullDateArray = explode('/', $fullDate);
			$monthYear = $fullDateArray[1]."/".$fullDateArray[2]; 

			$response = array();
			$purchasedItems = array();
			$response['monthYear'] = $monthYear;
			$response['totalLitres'] = $totalLitres;

			$res2 = mysqli_query($conn, "SELECT LPV FROM `tracker_config` WHERE `user_id` = '$user_id'");
			$config = mysqli_fetch_array($res2);

			$litrePrice = $config['LPV'];

			$response['litrePrice'] = $litrePrice;
			$response['totalMoney'] = $litrePrice * $totalLitres;

		}
	}

	$sql3 = "SELECT * FROM `purchased_items` WHERE `month` = '$month' AND `year` = '$currentYear'";
	$res3 = mysqli_query($conn, $sql3);

	if ($res3) {
		if (mysqli_num_rows($res3) == 0) {
			$response['sum_err'] = 1;
		}
		else{
			while ($rec = mysqli_fetch_array($res3)) {
				$purchasedItems[] = $rec;
			}
			
			$response['purchasedItems'] = $purchasedItems;
		
		}
	}

	echo json_encode($response);
?>