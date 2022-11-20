<?php
	function POSDisplayItems_SortName($con){
		$query = "SELECT * FROM `Inventory` ORDER BY Product_Name";
		$result = mysqli_query($con, $query);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$temp = $row['Product_Qty'];
				if ($temp > 0) {
					echo '<div class="productContainer" id="'.$row['Product_Name'].'" onclick="openItemsOverlay(); setProductName(this.id);">';
					echo '<div class="productContainerQty">';
					echo $row['Product_Qty'];
				}

				if ($temp == 0) {
					echo '<div class="disabled">';
					echo '<div class="productContainerQty">';
					echo '<span style="color:red">' . "0" . '</span>';
				}
					echo '</div>';

					echo '<div class="productContainerImage">';
						echo '<img src="upload/'.$row['Product_Name'].'.png">';
					echo '</div>';

					echo '<div class="productContainerName">';
						$product_Name = $row['Product_Name'];
						echo $product_Name;
					echo '</div>';

					echo '<div class="productContainerPrice">';
							echo "₱" . $row['Product_Price'];
					echo '</div>';
				echo '</div>';
			}
		}
	}

	function POSDisplayItems_SortPrice($con){
		$query = "SELECT * FROM `Inventory` ORDER BY Product_Price DESC";
		$result = mysqli_query($con, $query);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$temp = $row['Product_Qty'];
				if ($temp > 0) {
					echo '<div class="productContainer" id="'.$row['Product_Name'].'" onclick="openItemsOverlay(); setProductName(this.id);">';
					echo '<div class="productContainerQty">';
					echo $row['Product_Qty'];
				}

				if ($temp == 0) {
					echo '<div class="disabled">';
					echo '<div class="productContainerQty">';
					echo '<span style="color:red">' . "0" . '</span>';
				}
					echo '</div>';

					echo '<div class="productContainerImage">';
						echo '<img src="upload/'.$row['Product_Name'].'.png">';
					echo '</div>';

					echo '<div class="productContainerName">';
						$product_Name = $row['Product_Name'];
						echo $product_Name;
					echo '</div>';

					echo '<div class="productContainerPrice">';
							echo "₱" . $row['Product_Price'];
					echo '</div>';
				echo '</div>';
			}
		}
	}

	function POSDisplayItems_SortCategory($con){
		$query = "SELECT * FROM `Inventory` ORDER BY Product_Category";
		$result = mysqli_query($con, $query);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$temp = $row['Product_Qty'];
				if ($temp > 0) {
					echo '<div class="productContainer" id="'.$row['Product_Name'].'" onclick="openItemsOverlay(); setProductName(this.id);">';
					echo '<div class="productContainerQty">';
					echo $row['Product_Qty'];
				}

				if ($temp == 0) {
					echo '<div class="disabled">';
					echo '<div class="productContainerQty">';
					echo '<span style="color:red">' . "0" . '</span>';
				}
					echo '</div>';

					echo '<div class="productContainerImage">';
						echo '<img src="upload/'.$row['Product_Name'].'.png">';
					echo '</div>';

					echo '<div class="productContainerName">';
						$product_Name = $row['Product_Name'];
						echo $product_Name;
					echo '</div>';

					echo '<div class="productContainerPrice">';
							echo "₱" . $row['Product_Price'];
					echo '</div>';
				echo '</div>';
			}
		}
	}

	function POSDisplayItems_SortQty($con){
		$query = "SELECT * FROM `Inventory` ORDER BY Product_Qty DESC";
		$result = mysqli_query($con, $query);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$temp = $row['Product_Qty'];
				if ($temp > 0) {
					echo '<div class="productContainer" id="'.$row['Product_Name'].'" onclick="openItemsOverlay(); setProductName(this.id);">';
					echo '<div class="productContainerQty">';
					echo $row['Product_Qty'];
				}

				if ($temp == 0) {
					echo '<div class="disabled">';
					echo '<div class="productContainerQty">';
					echo '<span style="color:red">' . "0" . '</span>';
				}
					echo '</div>';

					echo '<div class="productContainerImage">';
						echo '<img src="upload/'.$row['Product_Name'].'.png">';
					echo '</div>';

					echo '<div class="productContainerName">';
						$product_Name = $row['Product_Name'];
						echo $product_Name;
					echo '</div>';

					echo '<div class="productContainerPrice">';
							echo "₱" . $row['Product_Price'];
					echo '</div>';
				echo '</div>';
			}
		}
	}

	//this function is to hide the undefined array key warning caused by the initial load of the POS system because the value of sort is undefined at first until the user chooses an option. there is a switch case with default that automatically loads the POS system by name so having a warning because of the undefined array key is irrelevant
	function definePOSSortOptions(){
		set_error_handler(function(int $errno, string $errstr) {
		    if ((strpos($errstr, 'Undefined array key') === false) && (strpos($errstr, 'Undefined variable') === false)) {
		        return false;
		    } else {
		        return true;
		    }
		}, E_WARNING);
	}

	function POSSearchResults($con){
		$search = $_GET["searchPOS"];
		$query = "SELECT * FROM `Inventory` WHERE Product_Name LIKE '%$search%' ORDER BY Product_Name";
		$result = mysqli_query($con, $query);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$temp = $row['Product_Qty'];
				if ($temp > 0) {
					echo '<div class="productContainer" id="'.$row['Product_Name'].'" onclick="openItemsOverlay(); setProductName(this.id);">';
					echo '<div class="productContainerQty">';
					echo $row['Product_Qty'];
				}

				if ($temp == 0) {
					echo '<div class="disabled">';
					echo '<div class="productContainerQty">';
					echo '<span style="color:red">' . "0" . '</span>';
				}
					echo '</div>';

					echo '<div class="productContainerImage">';
						echo '<img src="upload/'.$row['Product_Name'].'.png">';
					echo '</div>';

					echo '<div class="productContainerName">';
						$product_Name = $row['Product_Name'];
						echo $product_Name;
					echo '</div>';

					echo '<div class="productContainerPrice">';
							echo "₱" . $row['Product_Price'];
					echo '</div>';
				echo '</div>';
			}
		}
		else{
			echo "No results found, please try again.";
		}
	}

	function addToCart($con){
		if (!empty($_POST["addItemsAmount"])) {
			$Product_Name = $_POST["setProductName"];
			$qty = $_POST['addItemsAmount'];
			$query = "SELECT * FROM `Inventory` WHERE Product_Name LIKE '%$Product_Name%'";
			$result = mysqli_query($con, $query);
			$row = mysqli_fetch_assoc($result);
			$Product_Price = $row["Product_Price"];
			$items = array(
				$Product_Name => array(
					'Product_Name' => $Product_Name,
					'Product_Price' => $Product_Price,
					'Product_Qty' => $qty)

			);
			if (empty($_SESSION["cart"])) {
				$_SESSION["cart"] = $items;
			}
			else{
				$array_keys = array_keys($_SESSION["cart"]);
				if (in_array($Product_Name, $array_keys)) {
					$_SESSION["cart"][$Product_Name]["Product_Qty"]+= $_POST['addItemsAmount'];
				}
				else{
					$_SESSION["cart"] = array_merge($_SESSION["cart"], $items);
				}
			} 
		}
	}

	function displayCart($con){
		$_SESSION["total"] = 0;
		if (is_array($_SESSION["cart"])) {
				foreach ($_SESSION["cart"] as $product) {
					echo '<tr>';
						echo '<td rowspan="2" class="deleteItem">';
							echo '<form method="post" action"">';
								echo '<input type="hidden" name="productNameValue" value="'.$product['Product_Name'].'">';
								echo '<input type="hidden" name="action" value="remove">';
								echo '<button type="submit" class="remove">';
									echo "X";
								echo '</button>';
							echo '</form>';
						echo '</td>';

						echo '<td rowspan="2" class="imageItem">';
							echo '<img src="upload/'.$product['Product_Name'].'.png">';
						echo '</td>';

						echo '<td class="nameItem">';
							echo $product["Product_Name"];
						echo '</td>';

						echo '<td rowspan="2" class="qtyItem">';
							echo "x" . $product["Product_Qty"];
						echo '</td>';
					echo '</tr>';

					echo '<tr>';
						echo '<td class="priceItem">';
							echo "₱" . $product["Product_Price"] * $product["Product_Qty"];
						echo '</td>';
					echo '</tr>';
					$_SESSION["total"] += $product["Product_Price"] * $product["Product_Qty"];
			}
		}
	}

	function removeFromCart($con){
		if (isset($_POST['action']) && $_POST['action']=="remove") {
			if (!empty($_SESSION["cart"])) {
				foreach ($_SESSION["cart"] as $key => $value) {
					if ($_POST["productNameValue"] == $key) {
						unset($_SESSION["cart"][$key]);
					}
					if (empty($_SESSION["cart"])) {
						unset($_SESSION["cart"]);
					}
				}
			}
		}	
	}

	function totalPrice($con){
		if (empty($_SESSION["total"])) {
			echo "<p>Total: ₱0" . "</p>";
		}
		else{
			echo "<p>Total: ₱" . $_SESSION["total"] . "</p>";
		} 
	}

	function completeOrder($con){
		if (isset($_POST['complete']) && $_POST['complete']=="yes" && isset($_SESSION["cart"])) {
			$date = date('Y-m-d H:i:s');
			foreach ($_SESSION["cart"] as $product) {
				$logPOSDateTime = $date;
				$logPOSItemName = $product["Product_Name"];
				$logPOSQty = $product["Product_Qty"];
				$logPOSItemPrice = $product["Product_Price"] * $product["Product_Qty"];

				$logPOSData = "INSERT INTO POSLogs (POSLogDateTime, POSLogItems, POSLogQty, POSLogPrice) VALUES (?, ?, ?, ?)";
				$stmt = $con -> prepare($logPOSData);
				$stmt -> bind_param("ssii", $logPOSDateTime, $logPOSItemName, $logPOSQty, $logPOSItemPrice);
				$stmt -> execute();
				$stmt -> close();

				$updatePOSItemName = $product["Product_Name"];
				$updatePOSQty = $product["Product_Qty"];
				$updatePOSData = "UPDATE `Inventory` SET Product_Qty = (Product_Qty - $updatePOSQty) WHERE Product_Name LIKE '%$updatePOSItemName'";
				if (mysqli_query($con, $updatePOSData)) {
					
				}
				unset($_SESSION["cart"]);
			}
			echo '<script>alert("Order has been completed!")</script>';
		}
	}

	function displayLogs($con){
		$i = 0;
		$query = "SELECT * FROM `POSLogs` ORDER BY POSLogDateTime DESC";
		$result = mysqli_query($con, $query);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				if ($i % 2 == 0) {
					echo '<tr>';
						echo '<td class="POSLogLeft">';
							echo $row["POSLogDateTime"];
						echo '</td>';

						echo '<td>';
							echo $row["POSLogItems"] . " x" . $row["POSLogQty"];
						echo '</td>';

						echo '<td class="POSLogRight">';
							echo "₱" . $row["POSLogPrice"];
						echo '</td>';
					echo '</tr>';
				}

				if ($i % 2 == 1) {
					echo '<tr class="altColor">';
						echo '<td class="POSLogLeft">';
							echo $row["POSLogDateTime"];
						echo '</td>';

						echo '<td>';
							echo $row["POSLogItems"] . " x" . $row["POSLogQty"];
						echo '</td>';

						echo '<td class="POSLogRight">';
							echo "₱" . $row["POSLogPrice"];
						echo '</td>';
					echo '</tr>';
				}
				$i++;
			}
		}
	}
?>