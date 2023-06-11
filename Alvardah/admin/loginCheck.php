<?php
	
	// IMPORTING FILES
	include './phpStuff/coreFunctions.php';

	if (isset($_POST['submit'])) {
	      	
			$username = $_POST['adminName'];
			$password = $_POST['adminPass'];

			$filtered_data = filterCredentials($username, $password);

			$username = $filtered_data[0];
			$password = $filtered_data[1];

			$login_result = checkUser($username, $password);

	    }      

?>