<?php
session_start();

	// IMPORTING FILES
	include 'db_connection.php';



	// Redirecting Webpages
	function redirectTo($url)
	{
		header("location:". $url);
	}

	

	// Printing JavaScript PopUp
	function alert($msg)
	{
		echo "<script type='text/javascript'>alert('$msg');</script>";
	}


	// Filter The Input
	function filterCredentials($username, $password)
	{
		global $conn;

		$username = base64_encode($username);
		$password = base64_encode($password);
		
		$username = mysqli_real_escape_string($conn, $username);
		$password = mysqli_real_escape_string($conn, $password);

		return array($username, $password);
	}


	// Check If The User Exists
	function checkUser($username, $password)
	{
		global $conn;

		$query = "SELECT * FROM `admin` WHERE `name` = '$username' AND `password` = '$password'";

		$result = mysqli_query($conn, $query);

		$row  = mysqli_fetch_array($result);

		if ($row['name'] == $username && $row['password'] == $password) {
			
			$_SESSION['loggedIn'] = true;
			$_SESSION['user'] = $username;
			
			redirectTo("dashboard.php");
			exit;

		}

		else {
			$_SESSION['loggedIn'] = false;
			$_SESSION['message'] = "Login Failed! Please remember that the credentials are case sensitive.";

			redirectTo("index.php");
			exit;
		}
	}



	// Logout Function
	function logOut()
	{
		if (isset($_SESSION['loggedIn'])) {
			
			unset($_SESSION['loggedIn']);

			redirectTo('index.php');
			$_SESSION['message'] = "Logged Out Successfully!";
		}
	}



	// Generating Random Number
	function generateRandomNumber()
	{
		$first = rand(100,500);
		$second = rand(500,999);

		$str = str_shuffle($first . $second);

		return $str;
	}



	// Send Mail To Admin
	function mailAdmin($subject, $message)
	{
		mail('alvardah01@gmail.com', $subject , $message);
	}


	// Update Admin Password In Database
	function updateAdminPassword($password)
	{
		global $conn;

		$password = base64_encode($password);

		$query = "UPDATE `admin` SET `password`= '$password' WHERE id = '1'";

		$result = mysqli_query($conn, $query);

		if ($result) {
			return true;
		}

		else {
			return false;
		}
	}



	// Fetching Best Product Details From The DB
	function fetchBestProduct($id)
	{
		global $conn;

		$query = "SELECT * FROM `bestproduct` WHERE `id` = '$id'";

		$result = mysqli_query($conn, $query);

		$product = mysqli_fetch_array($result);
	
		return $product;
	}




	// Update Best Product Image

	function uploadBestProductImage($img_name, $img_type, $img_size, $tmp_name)
	{
		$img_ext_raw = explode('.', $img_name);
        

        $img_ext = strtolower(end($img_ext_raw));


        $location = './products/'.$img_name;

        $max_size = 400000;
        
            if ($img_size < $max_size && ($img_ext == "jpg" || $img_ext == "jpeg" || $img_ext == "png")) {
                
            
                if (move_uploaded_file($tmp_name, $location)) {
                    return true;
                }
            }
        else{
            return false;
        }
	}




	// Update Product Details
	function uploadBestProduct($name, $detail, $price, $img_name)
	{
		global $conn;

		$query = "UPDATE `bestproduct` SET `name`='$name',`details`='$detail',`price`= '$price', `pic`= '$img_name' WHERE `id` = '1'";

		$result = mysqli_query($conn, $query);

		if ($result) {
			return true;

		}
		else{
			return false;
		}
	}



	// Genetate Product ID
	function generateProductID()
	{
		$part1 = rand(100,999);
		$part2 = rand(10,99);

		$id = str_shuffle($part1 . $part2);

		return $id;
	}



	// Add image 
	function uploadProductImage($img_name, $img_type, $img_size, $tmp_name)
	{
		$img_ext_raw = explode('.', $img_name);
        

        $img_ext = strtolower(end($img_ext_raw));


        $location = './products/'.$img_name;

        $max_size = 350000;
        
            if ($img_size < $max_size && ($img_ext == "jpg" || $img_ext == "jpeg" || $img_ext == "png")) {
                
            
                if (move_uploaded_file($tmp_name, $location)) {
                    return true;
                }
            }
        else{
            return false;
        }
	}

	


	// Adding Product To The Databse
	function addProductToInventory($name, $detail, $price, $remark, $img_name)
	{
		global $conn;

		$productID = generateProductID();

		

		$query = "INSERT INTO `inventory`(`productid`, `name`, `detail`, `price`, `remark`, `pic`) 
		VALUES ('$productID', '$name', '$detail', '$price', '$remark', '$img_name')";
	
		$result = mysqli_query($conn, $query);

		if ($result) {
			redirectTo('dashboard.php');
		}
	

		else {
		}

		
	}



	// Deleting Product Recordset In DB
	function deleteProduct($id)
	{
		global $conn;

		$query = "DELETE FROM `inventory` WHERE `id` = '$id'";

		$result = mysqli_query($conn, $query);

		if ($result) {
			return true;
		}
		else{
			return false;
		}
	}



	// Updating Product Image 
	function updateProductImage($img_name, $img_size, $img_type, $tmp_name)
	{
		
		$img_ext_raw = explode('.', $img_name);
        

        $img_ext = strtolower(end($img_ext_raw));


        $location = './products/'.$img_name;

        $max_size = 350000;
        
            if ($img_size < $max_size && ($img_ext == "jpg" || $img_ext == "jpeg" || $img_ext == "png")) {
                
            
                if (move_uploaded_file($tmp_name, $location)) {
                    return true;
                }
            }
        else{
            return false;
        }

	}




	// Updating Product Details
	function updateProductDetails($id, $name, $detail, $price, $remark, $img_name)
	{
		global $conn;

		$query = "UPDATE `inventory` SET `name`= '$name' ,`detail`= '$detail' ,`price`= '$price',
		`remark`= '$remark',`pic`='$img_name' WHERE `id` = '$id'";

		$result = mysqli_query($conn, $query);

		if ($result) {
			return true;
		}
		else {
			return false;
		}
	}


	

	// Update Order Status
	function updateStatus($id, $status)
	{

		global $conn;

		$query = "UPDATE `orders` SET `status`= '$status' WHERE `id` = $id";

		$result = mysqli_query($conn, $query);

		if ($result) {
			redirectTo('dashboard.php');
		}

		else{
			echo "Something Went Wrong";
		}
	}



	// Uploading About Image
	function uploadBioImage($img_name, $img_type, $img_size, $tmp_name)
	{
		
		$img_ext_raw = explode('.', $img_name);
        

        $img_ext = strtolower(end($img_ext_raw));


        $location = './pix/'.$img_name;

        $max_size = 350000;
        
            if ($img_size < $max_size && ($img_ext == "jpg" || $img_ext == "jpeg" || $img_ext == "png")) {
                
            
                if (move_uploaded_file($tmp_name, $location)) {
                    return true;
                }
            }
        else{
            return false;
        }

	}




	// Updating About Details
	function updateAbout($name, $bio, $img_name)
	{
		global $conn;
		$sql = "UPDATE `about` SET `name`='$name',`bio`='$bio', `pic`='$img_name' WHERE `id` = '1'";
		$result = mysqli_query($conn, $sql);
		if ($result) {
			alert('Details Updated');
		}
	}





	// Adding New User
	function addUser($userName, $userPassword, $userEmail, $userNumber)
	{
		global $conn;
		
		$sql = "INSERT INTO `admin`(`name`, `password`, `email`, `number`) VALUES ('$userName' ,'$userPassword' ,'$userEmail' ,'$userNumber')";

		$result = mysqli_query($conn, $sql);

		if ($result) {
			return true;
		}
		else{
			return false;
		}
	}





	// Updating Quote 
	function updateQuote($author, $quote)
	{
		global $conn;
		$sql = "UPDATE `quotes` SET `quote`='$quote', `author`='$author'";
		$result = mysqli_query($conn, $sql);
		if ($result) {
			return true;
		}
		else{
			return false;
		}
	}






?>