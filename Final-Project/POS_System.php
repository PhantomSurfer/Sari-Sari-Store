<?php
include("POS_Connections.php");
include("POS_Functions.php");
session_start();
date_default_timezone_set("Asia/Manila");
?>

<!DOCTYPE html>
<html>
<head>
	<title>POS System</title>
	<link rel="stylesheet" type="text/css" href="asset/css/styles.css">
	<link href='https://fonts.googleapis.com/css?family=Kadwa' rel='stylesheet'>
	<script type="text/javascript" src="js/script.js"></script>
	<link rel="icon" type="image/png" href="asset/img/icons8-pos-32.png">
</head>
<body>
	<div id="navbar">
		<a href="employee-dashboard.php" id="homeIcon"><img src="asset/img/home icon.png"></a>
		<a href="POS_System.php" class="navigation"><u><b>POS</b></u></a>
		<p>|</p>
		<a href="POS_Logs.php" class="navigation">Logs</a>
		<div id="Logout">
			<a href="logout.php"><button>LOG - OUT</button>
			</a>
		</div>
	</div>

	<div id="POScontentWrapper">
		<div id="leftsideWrapper">
			<div id="sortPOS">
				<form method="post">
					<div id="POSSortWrapper">
						<?php 
							definePOSSortOptions(); 
							completeOrder($con);
						?>
						<label>Sort By: </label>
						<select id="POSSortOptions" name="POSSortOptions" onchange="this.form.submit();">
							<option value="POSSortName" 
								<?php if ($_POST["POSSortOptions"] == 'POSSortName') { ?>selected="true" <?php }; ?>>Name
							</option>

							<option value="POSSortPrice" 
								<?php if ($_POST["POSSortOptions"] == 'POSSortPrice') { ?>selected="true" <?php }; ?>>Price
							</option>

							<option value="POSSortCategory" 
								<?php if ($_POST["POSSortOptions"] == 'POSSortCategory') { ?>selected="true" <?php }; ?>>Category
							</option>

							<option value="POSSortQty" 
								<?php if ($_POST["POSSortOptions"] == 'POSSortQty') { ?>selected="true" <?php }; ?>>Stock Quantity
							</option>
						</select>
					</div>
				</form>

				<form method="get">
					<div id="POSSearchBoxWrapper">
						<img src="asset/img/search icon.png">
						<input type="text" name="searchPOS" id="searchPOS" placeholder="Search Product Name" value="<?php if (isset($_GET["searchPOS"])) echo $_GET["searchPOS"]; ?>">
					</div>
				</form>
			</div>

			<div id="itemsPOS">
				<?php
					$sortChoice = $_POST["POSSortOptions"];
					switch ($sortChoice) {
						default:
							POSDisplayItems_SortName($con);
							break;

						case 'POSSortName':
							POSDisplayItems_SortName($con);
							break;

						case 'POSSortPrice':
							POSDisplayItems_SortPrice($con);
							break;

						case 'POSSortCategory':
							POSDisplayItems_SortCategory($con);
							break;

						case 'POSSortQty':
							POSDisplayItems_SortQty($con);
							break;

						case !is_null($_POST["searchPOS"]):
							POSSearchResults($con);
							break;
					}
				?>
			</div>
		</div>

		<div id="addItemsOverlay" class="overlay">
			<div class="closebtn" onclick="closeItemsOverlay()">
				<p class="closebtnX">X</p>
  			</div>
  			<div class="overlay-content">
  				<form method="post">
  					<input type="text" id="setProductName" name="setProductName" hidden="" value="">
	  				<p id="addItemsName">
	  					
	  				</p>
	  				<div id="addItemsAmountWrapper">
		  				<label id="addItemsLabel">Amount: </label>
		  				<input type="number" id="addItemsAmount" name="addItemsAmount" max="120" required="">
		  				<input type="submit" id="addItemsButton" name="addItemsButton" value="Add">
	  				</div>
  				</form>
			</div>
		</div>

		<div id="rightsideWrapper">
			<div id="cartPOS">
				<table class="cartTable">
					<?php 
						addToCart($con);
						removeFromCart($con);
						displayCart($con);
					?>
				</table>
			</div>

			<div id="summaryPOS">
				<?php
					totalPrice($con);
				?>
				<div id="completeOrder">
					<form method="post" action="">
						<input type="hidden" name="complete" value="yes">
						<button type="submit" class="complete">
							Complete Order
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
