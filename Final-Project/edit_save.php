<?php
include("DB_Conn.php");
date_default_timezone_set("Asia/Manila");
session_start();

if (!empty($_POST["editProductName"])) {
    $Product_Name = $_POST["tempProductName"];
    $New_Product_Name = $_POST["editProductName"];
    $Product_Category = $_POST["editSortProductCategory"];
    $Product_Price = $_POST["editProductPrice"];
    $change = false;

    $invLogDateTime = date('Y-m-d H:i:s');
    $invLogAction = 'Edited';
    $invLogLocation = 'Item Setting';
    $invLogItem = $New_Product_Name;

    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image

    if (empty($_FILES["fileToUpload"]["tmp_name"])) {
        $old = $target_dir . $Product_Name . "." . "jpg";
        $new = $target_dir . $New_Product_Name . "." . "jpg";
        if (!rename($old, $new)) {
            $old = $target_dir . $Product_Name . "." . "jpeg";
            $new = $target_dir . $New_Product_Name . "." . "jpeg";
            if (!rename($old, $new)) {
            $old = $target_dir . $Product_Name . "." . "png";
            $new = $target_dir . $New_Product_Name . "." . "png";
        }
        }
        if (isset($_POST["editProductName"])) {
            $editData = "UPDATE inventory SET Product_Name='$New_Product_Name' WHERE Product_Name LIKE '%$Product_Name%'";
            if (mysqli_query($con, $editData)){
                $change = true;
            }

        }
        if (isset($_POST["editSortProductCategory"])) {
            $editData = "UPDATE inventory SET Product_Category='$Product_Category' WHERE Product_Name LIKE '%$Product_Name%'";
            if (mysqli_query($con, $editData)){
                $change = true;
            }
        }
        if (isset($_POST["editProductPrice"]) && $Product_Price != "") {
           $editData = "UPDATE inventory SET Product_Price='$Product_Price' WHERE Product_Name LIKE '%$Product_Name%'";
           if (mysqli_query($con, $editData)){
                $change = true;
            }
        }
        if ($change == true) {
            $logINVData = "INSERT INTO invlogs (INVLogDateTime, INVLogAction, INVLogLocation, INVLogItems) VALUES ('$invLogDateTime', '$invLogAction', '$invLogLocation', '$invLogItem')";
            mysqli_query($con, $logINVData);
            echo "Record updated successfully";
            $change = false;
            header('Location: INV_System.php');

        } else {
            echo "Error updating record: " . mysqli_error($con);
            $change = false;
            header('Location: INV_System.php');
        }
    }
    else{
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }


    // Check if file already exists
    if (file_exists($target_dir . $Product_Name . "." . $imageFileType)) {
    unlink($target_dir . $Product_Name . "." . $imageFileType);
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $New_Product_Name . "." . $imageFileType)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    }

    if (isset($_POST["editProductName"])) {
            $editData = "UPDATE inventory SET Product_Name='$New_Product_Name' WHERE Product_Name LIKE '%$Product_Name%'";
            if (mysqli_query($con, $editData)){
                $change = true;
            }

        }
        if (isset($_POST["editSortProductCategory"])) {
            $editData = "UPDATE inventory SET Product_Category='$Product_Category' WHERE Product_Name LIKE '%$Product_Name%'";
            if (mysqli_query($con, $editData)){
                $change = true;
            }
        }
        if (isset($_POST["editProductPrice"]) && $Product_Price != "") {
           $editData = "UPDATE inventory SET Product_Price='$Product_Price' WHERE Product_Name LIKE '%$Product_Name%'";
           if (mysqli_query($con, $editData)){
                $change = true;
            }
        }
        if ($change == true) {
        $logINVData = "INSERT INTO invlogs (INVLogDateTime, INVLogAction, INVLogLocation, INVLogItems) VALUES ('$invLogDateTime', '$invLogAction', '$invLogLocation', '$invLogItem')";
		mysqli_query($con, $logINVData);
        echo "Record updated successfully";
        $change = false;
        header('Location: INV_System.php');

    } else {
        echo "Error updating record: " . mysqli_error($con);
        $change = false;
        header('Location: INV_System.php');
    }
    }
}
?>