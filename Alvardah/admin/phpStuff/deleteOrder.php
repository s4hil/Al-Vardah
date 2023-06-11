<?php
ob_start();
require_once 'db_connection.php';
    if (isset($_GET['delOrdr'])) {
        $oID = $_GET['oID'];
        global $conn;
        $sql = "DELETE FROM `orders` WHERE `orderid` = '$oID'";
        $dlt_res = mysqli_query($conn, $sql);
        if ($dlt_res) {
            header('location:../dashboard.php');
        }
    }
ob_flush();
?>
