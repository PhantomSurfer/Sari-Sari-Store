<?php
include("DB_Conn.php");
include("INV_Function.php");
// We need to use sessions, so you should always start sessions using the below code.
date_default_timezone_set("Asia/Manila");
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>INV Logs</title>
	<link rel="stylesheet" type="text/css" href="asset/css/INV_style.css">
	<link href='https://fonts.googleapis.com/css?family=Kadwa' rel='stylesheet'>
	<link rel="icon" type="image/png" href="asset/img/icons8-new-product-32.png">
</head>
<body>
	<div id="navbar">
		<a href="employee-dashboard.php" id="homeIcon"><img src="asset/img/home icon.png"></a>
		<a href="INV_System.php" class="navigation">INV</a>
		<p>|</p>
		<a href="INV_Logs.php" class="navigation"><u><b>Logs</b></u></a>
		<div id="navbar-logout">
			<a href="logout.php"><button>LOG - OUT</button></a>
		</div>
	</div>

	<div id="POSLogsWrapper">
		<table id="POSLogsTable">
			<tr>
				<th id="POSDateTimeHeader">Date & Time</th>
				<th id="POSActionHeader">Action</th>
			</tr>
			<?php
				displayLogs($con);
			?>
		</table>
	</div>
</body>
</html>