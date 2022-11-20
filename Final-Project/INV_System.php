<?php
include("DB_Conn.php");
include("INV_Function.php");
date_default_timezone_set("Asia/Manila");
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>
<!DOCTYPE html>
<!-- NOTES:
FIXING THE EDIT SETTING
ADD LAST STOCK-->
<html>
    <head>
        <title>INV System</title>
        <link rel="stylesheet" href="asset/css/INV_style.css" />
        <link href="https://fonts.googleapis.com/css2?family=Kadwa&display=swap" rel="stylesheet">
        <script type="text/javascript" src="js/inv_script.js"></script>
        <link rel="icon" type="image/png" href="asset/img/icons8-new-product-32.png">
    </head>
    <body>
        <div id="navbar">
            <a href="employee-dashboard.php" id="homeIcon"><img src="asset/img/home icon.png"></a>
            <a href="INV_System.php" class="navigation"><u><b>INV</b></u></a>
            <p>|</p>
            <a href="INV_Log.php" class="navigation">Logs</a>
            <div id="navbar-logout">
                <a href="logout.php"><button>LOG - OUT</button>
                </a>
            </div>
	    </div>
        <div class="manage-option">
            <h2>Manage Option</h2>
            <button type="button" class="add-stock-button" onclick="openNewStockItem()">Add Stock</button>
        </div>
        <div class="setting-option">
            <div class="edit-options">
                <div class="sort-inv">
                    <form method="post">
                        <div id="sort-wrapper">
                            <?php defineSortOptions(); ?>
                            <label>Sort By: </label>
                            <select id="sortOptions" name="sortOptions" onchange="this.form.submit();">
                                <option value="SortName" 
                                    <?php if ($_POST["sortOptions"] == 'SortName') { ?>selected="true" <?php }; ?>>Name
                                </option>
    
                                <option value="SortPrice" 
                                    <?php if ($_POST["sortOptions"] == 'SortPrice') { ?>selected="true" <?php }; ?>>Price
                                </option>
    
                                <option value="SortCategory" 
                                    <?php if ($_POST["sortOptions"] == 'SortCategory') { ?>selected="true" <?php }; ?>>Category
                                </option>
    
                                <option value="SortQty" 
                                    <?php if ($_POST["sortOptions"] == 'SortQty') { ?>selected="true" <?php }; ?>>Stock Quantity
                                </option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
            <form method="get">
                <div id="search-box">
                    <img src="asset/img/search icon.png">
                    <input type="text" name="search-bar" id="search-bar" placeholder="Search..." value="<?php if (isset($_GET["search-bar"])) echo $_GET["search-bar"]; ?>">
                </div>
            </form>
        </div>
        <div id="itemsINV">
            <?php
                $sortChoice = $_POST["sortOptions"];
                switch ($sortChoice) {
                    default:
                        DisplayItems_SortName($con);
                        break;

                    case 'SortName':
                        DisplayItems_SortName($con);
                        break;

                    case 'SortPrice':
                        DisplayItems_SortPrice($con);
                        break;

                    case 'SortCategory':
                        DisplayItems_SortCategory($con);
                        break;

                    case 'SortQty':
                        DisplayItems_SortQty($con);
                        break;

                    case !is_null($_POST["search-bar"]):
                        SearchResults($con);
                        break;
                }
            ?>
        </div>
        <script>
            function openAddQtyPopUp(){
                document.getElementById("addPopupItem").style.display = "none";
                document.getElementById("addQtyPopup").style.display = "block";
            }

            function closeQtyOverlay(){
                document.getElementById("addQtyPopup").style.display = "none";
            }

            function openSettingPopUp(){
                document.getElementById("addPopupItem").style.display = "none";
                document.getElementById("itemSetting").style.display = "block";
            }

            function closeItemSetting(){
                document.getElementById("itemSetting").style.display = "none";
            }

            function openDeleteItemStock(){
                document.getElementById("itemSetting").style.display = "none";
                document.getElementById("deleteItemStock").style.display = "block";
            }

            function closeDeleteItemStock(){
                document.getElementById("deleteItemStock").style.display = "none";
            }
            function openNewStockItem(){
                document.getElementById("newItemStock").style.display = "block";
            }

            function closeNewItemStock(){
                document.getElementById("newItemStock").style.display = "none";
            }

            function deleteProductName(clicked_id){
                document.getElementById('deleteProductName').setAttribute('value', clicked_id);
            }

            function ItemProductName(clicked_id){
                document.getElementById('editProductName').setAttribute('value', clicked_id);
                document.getElementById('tempProductName').setAttribute('value', clicked_id);
            }
        </script>
        
        <div id="newItemStock" class="overlay">
            <div class="overlay-content">
                <img src="asset/img/close.png" alt="Close" class="closebutton" onclick="closeNewItemStock()"/>
                <form method="post" action="new_item.php" enctype="multipart/form-data">
                <table class="editMenu">
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <td colspan="3"><label for="newProductName">Product Name:</label></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <input type="text" id="newProductName" name="newProductName" class="maxTD"></input>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"><label for="newProductCategory">Category:</label></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <select name="newProductCategory" class="maxTD">
                                    <option value="" disabled selected>--Choose an Option--</option>
                                    <option value="Drinking Water">Drinking Water</option>
                                    <option value="Powdered Drink">Powdered Drink</option>
                                    <option value="Sports Drink">Sports Drink</option>
                                    <option value="Water">Water</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="newProductQty">Qty Items:</label></td>
                            <td></td>
                            <td><label for="newProductPrice">Price:</label></td>
                        </tr>
                        <tr>
                            <td><input type="number" id="newProductQty" name="newProductQty" class="minTD"></input></td>
                            <td></td>
                            <td><input type="number" id="newProductPrice" name="newProductPrice" class="minTD"></input></td>
                        </tr>
                        <tr>
                            <td colspan="3"><label>Item Image:</label></td>
                        </tr>
                        <tr>
                            <td colspan="3"><input type="file" name="UploadImage" id="UploadImage"></input></td> <!--This needs to be edited-->
                        </tr>
                        <tr>
                            <td colspan="3"><input type="submit" id="insertNewProduct" name="insertNewProduct" value="Add Stock" class="editSubmitBtn" /></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

        <div id="addPopupItem" class="overlay">
  			<div class="overlay-content">
                <img src="asset/img/close.png" alt="Close" class="closebutton" onclick="closeItemsOverlay()"/>
                <button type="button" class="addPopupBtn" onclick="openAddQtyPopUp()">Add Item Qty</button>
                <button type="button" class="addPopupBtn" onclick="openSettingPopUp()">Item Setting</button>
			</div>
		</div>

        <div id="addQtyPopup" class="overlay">
            <div class="overlay-content">
                <img src="asset/img/close.png" alt="Close" class="closebutton" onclick="closeQtyOverlay()"/>
                <form method="post" action="addItemQty.php">
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

        <div id="itemSetting" class="overlay">
            <div class="overlay-content">
                <img src="asset/img/close.png" alt="Close" class="closebutton" onclick="closeItemSetting()"/>
                <form method="post" action="edit_save.php" enctype="multipart/form-data">
                    <table class="editMenu">
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <td colspan="3"><label for="editProductName">Product Name:</label></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <input type="text" id="tempProductName" name="tempProductName" value="" hidden="" />
                                <input type="text" id="editProductName" name="editProductName" value="" class="maxTD"></input>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"><label for="editProductCategory">Category:</label></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <select name="editSortProductCategory" class="maxTD">
                                    <option value="" disabled selected>--Choose an Option--</option> <!--This needs to be edited-->
                                    <option value="Drinking Water">Drinking Water</option>
                                    <option value="Powdered Drink">Powdered Drink</option>
                                    <option value="Sports Drink">Sports Drink</option>
                                    <option value="Water">Water</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="editProductQty">Qty Items:</label></td>
                            <td></td>
                            <td><label for="editProductPrice">Price:</label></td>
                        </tr>
                        <tr>
                            <td><input type="number" id="editProductQty" name="editProductQty" value="" disabled class="minTD" placeholder="000"></input></td>
                            <td></td>
                            <td><input type="number" id="editProductPrice" name="editProductPrice" class="minTD" placeholder="000"></input></td>
                        </tr>
                        <tr>
                            <td colspan="3"><label>Item Image:</label></td>
                        </tr>
                        <tr>
                            <td colspan="3"><input type="file" name="fileToUpload" id="fileToUpload"></input></td> <!--This needs to be edited-->
                        </tr>
                        <tr>
                            <td><button type="button" class="deleteItemStock" onclick="openDeleteItemStock()">Delete Stock</button></td>
                            <td></td>
                            <td><input type="submit" id="updateProductSetting" name="updateProductSetting" value="Save Setting" class="editSubmitBtn" /></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div id="deleteItemStock" class="overlay">
            <div class="overlay-content">
                <img src="asset/img/close.png" alt="Close" class="closebutton" onclick="closeDeleteItemStock()"/>
                <form method="post" action="deleteItem.php">
                    <input type="text" id="deleteProductName" name="deleteProductName" hidden="" value="">
	  				<p class="deleteParagraph">Are You Sure?</p>
	  				<div id="deleteWrapper">
		  				<input type="submit" id="deleteItem" name="deleteItem" value="Yes">
                        <button type="button" class="closeDeletePopUp" onclick="closeDeleteItemStock()">No</button>
	  				</div>
                </form>
            </div>
        </div>
    </body>
</html>