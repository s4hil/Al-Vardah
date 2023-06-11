<?php
	include 'config.php';
	header('Access-Control-Allow-Origin');
	$data = json_decode(file_get_contents("php://input"), true);

	$username = clean(mysqli_real_escape_string($conn, $data['username']));
	$password = clean(mysqli_real_escape_string($conn, $data['password']));
	$email = clean(mysqli_real_escape_string($conn, $data['email']));

	$username = strtolower($username);
	$password = strtolower($password);

	$sql = "INSERT INTO `users` (`username`, `password`, `email`) 
			VALUES ('$username', '$password', '$email')";

	$res = mysqli_query($conn, $sql);
	if ($res) {
		$response['msg'] = "Account Created!";
		$response['status'] =  true;
	}
	else {
		$response['msg'] = "Failed To Create Account!";
		$response['status'] =  false;
	}
	echo json_encode($response);
?>