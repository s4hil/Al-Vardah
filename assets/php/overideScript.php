<?php
	// Override Records Script

	$db_host = "localhost";
	$db_user = "root";
	$db_pass = "";
	$db_name = "dairy_tracker";

	$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name) or die('Failed to connect');
	
	$data = json_decode(file_get_contents("php://input"), true);

	$date = $data['date'];
	$quantity = $data['quantity'];
	$dateArray = explode('/', $date);
	$month = $dateArray[1];

	$sql = "INSERT INTO `dairy_records` (`date`,`month`, `quantity`) VALUES('$date','$month','$quantity')";
	$res = mysqli_query($conn, $sql);
	if ($res) {
		echo json_encode("Saved");
	}
	else {
		echo json_encode("not Saved");
	}
?>