<?php
include("DB_Conn.php");
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT password FROM account WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Inventory</title>
        <link rel="stylesheet" href="asset/css/employee-dashboard.css" />
        <link href="https://fonts.googleapis.com/css2?family=Kadwa&display=swap" rel="stylesheet">
        <link rel="icon" type="image/png" href="asset/img/icons8-dashboard-layout-32.png">
    </head>
    <body>
        <nav class="navbar">
            <h1>Welcome, <?=$_SESSION['name']?> </h1>
            <a class="logout-button" href="logout.php">LOG - OUT</a>
        </nav>
        <div id="dashboard-content">
            <ul class="directory-list">
                <li>
                    <a class="directory-button" href="INV_System.php">
                        <img src="asset/img/inventory-employee-button-black.png" alt="Inventory Image" />
                        <h3>Inventory</h3>
                    </a>
                </li>
                <li>
                    <a class="directory-button" href="POS_System.php">
                        <img src="asset/img/pos-employee-button-black.png" alt="POS Image" />
                        <h3>POS</h3>
                    </a>
                </li>
            </ul>
        </div>
    </body>
</html>