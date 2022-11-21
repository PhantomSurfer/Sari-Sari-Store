<?php
include("DB_Conn.php");
date_default_timezone_set("Asia/Manila");
session_start();

if (!empty($_POST["addItemsAmount"])) {
    $Product_Name = $_POST["setProductName"];
    $qty = $_POST['addItemsAmount'];
    $invLogDateTime = date('Y-m-d H:i:s');
    $invLogAction = 'Added';
    $invLogLocation = 'Item Stock';
    $invLogItem = $Product_Name;
    $query = "SELECT * FROM `Inventory` WHERE Product_Name LIKE '%$Product_Name%'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $New_Product_Qty = $qty + $row["Product_Qty"];

    $addData = "UPDATE `Inventory` SET Product_Qty=$New_Product_Qty WHERE Product_Name LIKE '%$Product_Name%'";
    if (mysqli_query($con, $addData)) {
        $logINVData = "INSERT INTO invlogs (INVLogDateTime, INVLogAction, INVLogLocation, INVLogItems) VALUES ('$invLogDateTime', '$invLogAction', '$invLogLocation', '$invLogItem')";
		mysqli_query($con, $logINVData);
        echo "Record updated successfully";
        header('Location: INV_System.php');

    } else {
	echo '<script>alert("An Error Has Occurred!")</script>';
        echo 'Error updating record: ' . mysqli_error($con);
        header('Location: INV_System.php');
    }
}
?>
