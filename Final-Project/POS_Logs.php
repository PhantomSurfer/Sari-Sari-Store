<?php
include("POS_Connections.php");
include("POS_Functions.php");
date_default_timezone_set("Asia/Manila");
?>

<!DOCTYPE html>
<html>
<head>
	<title>POS Logs</title>
	<link rel="stylesheet" type="text/css" href="asset/css/styles.css">
	<link href='https://fonts.googleapis.com/css?family=Kadwa' rel='stylesheet'>
	<link rel="icon" type="image/png" href="asset/img/icons8-pos-32.png">
</head>
<body>
	<div id="navbar">
		<a href="employee-dashboard.php" id="homeIcon"><img src="asset/img/home icon.png"></a>
		<a href="POS_System.php" class="navigation">POS</a>
		<p>|</p>
		<a href="POS_Logs.php" class="navigation"><u><b>Logs</b></u></a>
		<div id="Logout">
			<a href="logout.php"><button>LOG - OUT</button></a>
		</div>
	</div>

	<div id="POSLogsWrapper">
		<table id="POSLogsTable">
			<tr>
				<th id="POSDateTimeHeader">Date & Time</th>
				<th id="POSItemsHeader">Items</th>
				<th id="POSTotalHeader">Total Price</th>
			</tr>
			<?php
				displayLogs($con);
			?>
		</table>
	</div>
</body>
</html>