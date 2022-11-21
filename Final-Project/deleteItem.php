<?php
include("DB_Conn.php");
date_default_timezone_set("Asia/Manila");
session_start();

if (!empty($_POST["deleteProductName"])) {
    $Product_Name = $_POST["deleteProductName"];
    
    $invLogDateTime = date('Y-m-d H:i:s');
    $invLogAction = 'Delete';
    $invLogLocation = 'Item Setting';
    $invLogItem = $Product_Name;

    $delete = "DELETE FROM `inventory` WHERE `Product_Name` = '$Product_Name'";
    if (mysqli_query($con, $delete)){
        $logINVData = "INSERT INTO invlogs (INVLogDateTime, INVLogAction, INVLogLocation, INVLogItems) VALUES ('$invLogDateTime', '$invLogAction', '$invLogLocation', '$invLogItem')";
		mysqli_query($con, $logINVData);
        header('Location: INV_System.php');
    }
    else {
	echo '<script>alert("An Error Occurred!")</script>';
        echo "Error updating record: " . mysqli_error($con);
        header('Location: INV_System.php');
    }
}
?>
