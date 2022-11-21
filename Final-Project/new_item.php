<?php
include("DB_Conn.php");
date_default_timezone_set("Asia/Manila");
session_start();

if (!empty($_POST["newProductName"])) {
    $Product_Name = $_POST["newProductName"];
    $Product_Category = $_POST["newProductCategory"];
    $Product_Qty = $_POST["newProductQty"];
    $Product_Price = $_POST["newProductPrice"];

    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["UploadImage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["UploadImage"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }


    // Check if file already exists
    if (file_exists($target_file)) {
    echo '<script>alert("Sorry, Image File already exists.")</script>';
    echo "Sorry, file already exists.";
    $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["UploadImage"]["size"] > 500000) {
    echo '<script>alert("Sorry, Image Files is too large.")</script>';
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "png") {
    echo '<script>alert("Sorry, Only PNG files are allowed.")</script>';
    echo "Sorry, PNG files are allowed.";
    $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
    if (move_uploaded_file($_FILES["UploadImage"]["tmp_name"], $target_dir . $Product_Name . "." . $imageFileType)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["UploadImage"]["name"])). " has been uploaded.";
    } else {
	echo '<script>alert("An Error has Occurred! Updload Image File Failed")</script>';
        echo "Sorry, there was an error uploading your file.";
    }
    }

    $invLogDateTime = date('Y-m-d H:i:s');
    $invLogAction = 'Added';
    $invLogLocation = 'New Item';
    $invLogItem = $Product_Name;

    $check = "SELECT `Product_Name` FROM inventory WHERE `Product_Name` = '$Product_Name'";
    $check_run = mysqli_query($con, $check);
    if (mysqli_num_rows($check_run)==1){
	echo '<script>alert("New Item Product already exists in stock.")</script>';
        header('Location: INV_Log.php');
    }
    else {
        $insert = "INSERT INTO `inventory` (`Product_Name`, `Product_Price` , `Product_Qty`, `Product_Category`) VALUES ('$Product_Name', '$Product_Price', '$Product_Qty', '$Product_Category')";
        if (mysqli_query($con, $insert)) {
            $logINVData = "INSERT INTO invlogs (INVLogDateTime, INVLogAction, INVLogLocation, INVLogItems) VALUES ('$invLogDateTime', '$invLogAction', '$invLogLocation', '$invLogItem')";
		    mysqli_query($con, $logINVData);
            echo "Record updated successfully";
            header('Location: INV_System.php');
    
        } else {
	    echo '<script>alert("An Error has Occurred")</script>';
            echo "Error updating record: " . mysqli_error($con);
            header('Location: INV_System.php');
        }
    }
}
?>
