<?php
	function DisplayItems_SortName($con){
		$query = "SELECT * FROM `Inventory` ORDER BY Product_Name";
		$result = mysqli_query($con, $query);
		if (mysqli_num_rows($result) > 0) {
            $table = '
                <table class="Inventory-Table">
                    <thead>
                        <tr>
							<th>Action</th>
                            <th>Product-Name</th>
                            <th>Product-Category</th>
                            <th>Item-Qty</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                ';
			while ($row = mysqli_fetch_assoc($result)) {
  
            $table .= '
                    <tr>
						<td><button type="button" class="productactionbutton" id="'.$row['Product_Name'].'" onclick="openItemsOverlay(); setProductName(this.id); deleteProductName(this.id); ItemProductName(this.id);">Add/Setting</button></td>
                        <td>'.$row["Product_Name"].'</td>
                        <td>'.$row["Product_Category"].'</td>
                        <td>'.$row["Product_Qty"].'</td>
                        <td>₱'.$row["Product_Price"].'</td>
                    </tr>
                ';
			}
            $table .= '</tbody></table>';
            echo $table;
		}
	}

	function DisplayItems_SortPrice($con){
		$query = "SELECT * FROM `Inventory` ORDER BY Product_Price DESC";
        $result = mysqli_query($con, $query);
		if (mysqli_num_rows($result) > 0) {
            $table = '
                <table class="Inventory-Table">
                    <thead>
                        <tr>
							<th>Action</th>
                            <th>Product-Name</th>
                            <th>Product-Category</th>
                            <th>Item-Qty</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                ';
			while ($row = mysqli_fetch_assoc($result)) {
  
            $table .= '
                    <tr>
						<td><button type="button" class="productactionbutton" id="'.$row['Product_Name'].'" onclick="openItemsOverlay(); setProductName(this.id); deleteProductName(this.id); ItemProductName(this.id);">Add/Setting</button></td>
                        <td>'.$row["Product_Name"].'</td>
                        <td>'.$row["Product_Category"].'</td>
                        <td>'.$row["Product_Qty"].'</td>
                        <td>₱'.$row["Product_Price"].'</td>
                    </tr>
                ';
			}
            $table .= '</tbody></table>';
            echo $table;
		}
	}

	function DisplayItems_SortCategory($con){
		$query = "SELECT * FROM `Inventory` ORDER BY Product_Category";
		$result = mysqli_query($con, $query);
		if (mysqli_num_rows($result) > 0) {
            $table = '
                <table class="Inventory-Table">
                    <thead>
                        <tr>
							<th>Action</th>
                            <th>Product-Name</th>
                            <th>Product-Category</th>
                            <th>Item-Qty</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                ';
			while ($row = mysqli_fetch_assoc($result)) {
  
            $table .= '
                    <tr>
						<td><button type="button" class="productactionbutton" id="'.$row['Product_Name'].'" onclick="openItemsOverlay(); setProductName(this.id); deleteProductName(this.id); ItemProductName(this.id);">Add/Setting</button></td>
                        <td>'.$row["Product_Name"].'</td>
                        <td>'.$row["Product_Category"].'</td>
                        <td>'.$row["Product_Qty"].'</td>
                        <td>₱'.$row["Product_Price"].'</td>
                    </tr>
                ';
			}
            $table .= '</tbody></table>';
            echo $table;
		}
	}

	function DisplayItems_SortQty($con){
		$query = "SELECT * FROM `Inventory` ORDER BY Product_Qty DESC";
		$result = mysqli_query($con, $query);
		if (mysqli_num_rows($result) > 0) {
            $table = '
                <table class="Inventory-Table">
                    <thead>
                        <tr>
							<th>Action</th>
                            <th>Product-Name</th>
                            <th>Product-Category</th>
                            <th>Item-Qty</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                ';
			while ($row = mysqli_fetch_assoc($result)) {
  
            $table .= '
                    <tr>
						<td><button type="button" class="productactionbutton" id="'.$row['Product_Name'].'" onclick="openItemsOverlay(); setProductName(this.id); deleteProductName(this.id); ItemProductName(this.id);">Add/Setting</button></td>
                        <td>'.$row["Product_Name"].'</td>
                        <td>'.$row["Product_Category"].'</td>
                        <td>'.$row["Product_Qty"].'</td>
                        <td>₱'.$row["Product_Price"].'</td>
                    </tr>
                ';
			}
            $table .= '</tbody></table>';
            echo $table;
		}
	}

	//this function is to hide the undefined array key warning caused by the initial load of the POS system because the value of sort is undefined at first until the user chooses an option. there is a switch case with default that automatically loads the POS system by name so having a warning because of the undefined array key is irrelevant
	function defineSortOptions(){
		set_error_handler(function(int $errno, string $errstr) {
		    if ((strpos($errstr, 'Undefined array key') === false) && (strpos($errstr, 'Undefined variable') === false)) {
		        return false;
		    } else {
		        return true;
		    }
		}, E_WARNING);
	}

	function SearchResults($con){
		$search = $_GET["search-bar"];
		$query = "SELECT * FROM `Inventory` WHERE Product_Name LIKE '%$search%' ORDER BY Product_Name";
		$result = mysqli_query($con, $query);
		if (mysqli_num_rows($result) > 0) {
			$table = '
                <table class="Inventory-Table">
                    <thead>
                        <tr>
							<th>Action</th>
                            <th>Product-Name</th>
                            <th>Product-Category</th>
                            <th>Item-Qty</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                ';
			while ($row = mysqli_fetch_assoc($result)) {
  
            $table .= '
                    <tr>
						<td><button type="button" class="productactionbutton" id="'.$row['Product_Name'].'" onclick="openItemsOverlay(); setProductName(this.id); deleteProductName(this.id); ItemProductName(this.id);">Add/Setting</button></td>
                        <td>'.$row["Product_Name"].'</td>
                        <td>'.$row["Product_Category"].'</td>
                        <td>'.$row["Product_Qty"].'</td>
                        <td>₱'.$row["Product_Price"].'</td>
                    </tr>
                ';
			}
            $table .= '</tbody></table>';
            echo $table;
			}
		else{
			echo '<script>alert(No results found, please try again.)</script>';
		}
	}

	function displayLogs($con){
		$i = 0;
		$query = "SELECT * FROM `invlogs` ORDER BY INVLogDateTime";
		$result = mysqli_query($con, $query);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				if ($i % 2 == 0) {
					echo '<tr>';
						echo '<td class="POSLogLeft">';
							echo $row["INVLogDateTime"];
						echo '</td>';

						echo '<td>';
							echo $row["INVLogAction"] . " - " . $row["INVLogLocation"] . " - " . $row["INVLogItems"];
						echo '</td>';
					echo '</tr>';
				}

				if ($i % 2 == 1) {
					echo '<tr class="altColor">';
						echo '<td class="POSLogLeft">';
							echo $row["INVLogDateTime"];
						echo '</td>';

						echo '<td>';
							echo $row["INVLogAction"] . " - " . $row["INVLogLocation"] . " - " . $row["INVLogItems"];
						echo '</td>';
					echo '</tr>';
				}
				$i++;
			}
		}
	}
?>
