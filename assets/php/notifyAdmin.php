<?php
	
$db_host = "localhost";
$db_user = "u883347914_thealphacoder";
$db_pass = "Alpha@675";
$db_name = "u883347914_dairy_tracker";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name) or die('Failed to connect');

function sendMessage($chatID, $messaggio, $token) {

    $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID;
    $url = $url . "&text=" . urlencode($messaggio);
    $ch = curl_init();
    $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

function getUserName($id)
{
	global $conn;
	$sql = "SELECT * FROM `users` WHERE `user_id` = '$id'";
	$res = mysqli_query($conn, $sql);
	$user = mysqli_fetch_array($res);
	$userName = $user['username'];
	return ucfirst($userName);
}

function fetchDate()
{
	$today = date('d/m/Y');
	$todayArr = explode('/', $today);

	$day = $todayArr[0];
	$month = $todayArr[1];
	$year = $todayArr[2];
	if ($day[0] == 0) {
		$day = str_replace('0', '', $day);
	}
	if ($month[0] == 0) {
		$month = str_replace('0', '', $month);
	}

	return $day."/".$month."/".$year;
}
?>

<?php

	$sql = "SELECT * FROM `tracker_config`";
	$res = mysqli_query($conn, $sql);
	while ($config = mysqli_fetch_array($res)) {
		
		$user_id = $config['user_id'];
		$date = fetchDate();

		$checkRecs = "SELECT * FROM `dairy_records` WHERE `user_id` = '$user_id' AND `date` = '$date'";
		$resCheckRecs = mysqli_query($conn, $checkRecs);
		if (mysqli_num_rows($resCheckRecs) == 0) {

			$name = getUserName($config['user_id']);
			$chatID = $config['telegram_chat_id'];
			$token = $config['telegram_auth_token'];
			$msg = "Dear ". $name .", You've not added the entry of the day: ".$date.". 
			
			Regards, 
			Alpha Coder.";
			sendMessage($chatID, $msg, $token);
		}
	}
?>