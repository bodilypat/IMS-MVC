<?php

// Updated script - 2018-05-09

	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');
	
	if(isset($_POST['purchaseDetailsPurchaseID'])){

		$purchaseItemNumber = htmlentities($_POST['purItemNumber']);
		$purchaseDate = htmlentities($_POST['purchaseDate']);
		$purchaseItemName = htmlentities($_POST['purchaseItemName']);
		$purchaseQuantity = htmlentities($_POST['purchaseQuantity']);
		$purchaseUnitPrice = htmlentities($_POST['purchaseUnitPrice']);
		$purchasePurchaseID = htmlentities($_POST['purchaseID']);
		$purchaseVendorName = htmlentities($_POST['purchaseVendorName']);
		
		$quantityOldOrder = 0;
		$quantityNewOrder = 0;
		$oldStockInItem = 0;
		$newStock = 0;
		$orderItemNumber = '';
		
		// Check if mandatory fields are not empty
		if(isset($purchaseItemNumber) && isset($purchaseDate) && isset($purchaseQuantity) && isset($purchaseUnitPrice)){
			
			// Sanitize item number
			$purchaseItemNumber = filter_var($purchaseItemNumber, FILTER_SANITIZE_STRING);
			
			// Validate item quantity. It has to be an integer
			if(filter_var($purchaseQuantity, FILTER_VALIDATE_INT) === 0 || filter_var($purchaseQuantity, FILTER_VALIDATE_INT)){
				// Quantity is valid
			} else {
				// Quantity is not a valid number
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for quantity.</div>';
				exit();
			}
			
			// Validate unit price. It has to be an integer or floating point value
			if(filter_var($purchaseUnitPrice, FILTER_VALIDATE_FLOAT) === 0.0 || filter_var($purchaseUnitPrice, FILTER_VALIDATE_FLOAT)){
				// Valid unit price
			} else {
				// Unit price is not a valid number
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for unit price.</div>';
				exit();
			}
			
			// Check if purchaseID is empty
			if($purchaseID == ''){ 
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a Purchase ID.</div>';
				exit();
			}
			
			// Check if itemNumber is empty
			if($purchaseItemNumber == ''){ 
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter Item Number.</div>';
				exit();
			}
			
			// Check if quantity is empty
			if($purchaseQuantity == ''){ 
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter quantity.</div>';
				exit();
			}
			
			// Get the quantity and itemNumber in original purchase order
			
			$queryPurchase = 'SELECT * FROM purchase WHERE purchaseID = :purchaseID';
			$purchaseStatement = $conn->prepare($queryPurchase);
			$purchaseStatement->execute(['purchaseID' => $purchaseID]);
			
			// Get the vendorId for the given vendorName
			
			$queryVendor = 'SELECT * FROM vendor WHERE fullName = :fullName';
			$vendorStatement = $conn->prepare($queryVendor);
			$vendorStatement->execute(['fullName' => $purchaseVendorName]);
			$row = $vendorStatement->fetch(PDO::FETCH_ASSOC);
			$vendorID = $row['vendorID'];
			
			if($PurchaseStatement->rowCount() > 0){
				
				// Purchase details exist in DB. Hence proceed to calculate the stock
				$quantityRow = $purchaseStatement->fetch(PDO::FETCH_ASSOC);
				$quantityOrder = $quantityRow['quantity'];
				$orderItemNumber = $quantityRow['itemNumber'];

				// Check if the user wants to update the itemNumber too. In that case,
				// we need to remove the quantity of the original order for that item and 
				// update the new item details in the item table.
				// Check if the original itemNumber is the same as the new itemNumber
				if($orderItemNumber !== $purchaseItemNumber) {
					// Item numbers are different. That means the user wants to update a new item number too
					// in that case, need to update both items' stocks.
						
					// Get the stock of the new item from item table
					
					$queryItemStock = 'SELECT * FROM item WHERE itemNumber = :itemNumber';
					$itemCurrentStockStatement = $conn->prepare($queryItemStock);
					$itemCurrentStockStatement->execute(['itemNumber' => $purchaseItemNumber]);
					
					if($itemCurrentStockStatement->rowCount() < 1){
						// Item number is not in DB. Hence abort.
						echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Item Number does not exist in DB. If you want to update this item, please add it to DB first.</div>';
						exit();
					}
					
					// Calculate the new stock value for new item using the existing stock in item table
					
					$itemRow = $itemCurrentStockStatement->fetch(PDO::FETCH_ASSOC);
					$quantityItem = $itemRow['stock'];
					$quantityNewItem = $purchaseQuantity;
					$newItemStock = $quantityItem + $quantityNewItem;
					
					// Edit the stock for new item in item table
					
					$editItemStock = 'UPDATE item SET stock = :stock WHERE itemNumber = :itemNumber';
					$updateItemStockStatement = $conn->prepare($editItemStock);
					$updatetemStockStatement->execute(['stock' => $newItemStock, 'itemNumber' => $purchaseItemNumber]);
					
					// Get the current stock of the previous item
					
					$queryStock = 'SELECT * FROM item WHERE itemNumber=:itemNumber';
					$itemStockStatement = $conn->prepare($queryStock);
					$itemStockStatement->execute(['itemNumber' => $OrderItemNumber]);
					
					// Calculate the new stock value for the previous item using the existing stock in item table
					
					$itemRow = $itemStockStatement->fetch(PDO::FETCH_ASSOC);
					$currentQuantityItem = $itemRow['stock'];
					$itemNewStock = $currentQuantityItem - $quantityOrder;
					
					// EDIT the stock for previous item in item table
					
					$editItemStock = 'UPDATE item SET stock = :stock WHERE itemNumber = :itemNumber';
					$updateItemStockStatement = $conn->prepare($editItemStock);
					$updateItemStockStatement->execute(['stock' => $itemNewStock, 'itemNumber' => $OrderItemNumber]);
					
					// Finally UPDATE the purchase table for new item
					
					$updatePurchase = 'UPDATE purchase SET itemNumber = :itemNumber, purchaseDate = :purchaseDate, itemName = :itemName, unitPrice = :unitPrice, quantity = :quantity, vendorName = :vendorName, vendorID = :vendorID WHERE purchaseID = :purchaseID';
					$updatePurchaseStatement = $conn->prepare($updatePurchase);
					$updatePurchaseStatement->execute(['itemNumber' => $purchaseItemNumber, 'purchaseDate' => $purchaseDate, 'itemName' => $purchaseItemName, 'unitPrice' => $purchaseUnitPrice, 'quantity' => $purchaseQuantity, 'vendorName' => $purchaseVendorName, 'vendorID' => $vendorID, 'purchaseID' => $purchaseID]);
					
					echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Purchase details added to database and stock values updated.</div>';
					exit();
					
				} else {
					// Item numbers are equal. That means item number is valid
					
					// Get the quantity (stock) in item table
					
					$queryStock = 'SELECT * FROM item WHERE itemNumber=:itemNumber';
					$stockStatement = $conn->prepare($queryStock);
					$stockStatement->execute(['itemNumber' => $purchaseItemNumber]);
					
					if($stockStatement->rowCount() > 0){
						// Item exists in the item table, therefore, start inserting data to purchase table
						
						// Calculate the new stock value using the existing stock in item table
						
						$row = $stockStatement->fetch(PDO::FETCH_ASSOC);
						$quantityNewOrder = $purchaseQuantity;
						$originalStockItem = $row['stock'];
						$newStock = $originalStockItem + ($quantityNewOrder - $quantityOrder);
						
						// Update the new stock value in item table.
						
						$editStock = 'UPDATE item SET stock = :stock WHERE itemNumber = :itemNumber';
						$updateStockStatement = $conn->prepare($editStock);
						$updateStockStatement->execute(['stock' => $newStock, 'itemNumber' => $purchaseItemNumber]);
						
						// Next, update the purchase table
						
						$updatePurchase = 'UPDATE purchase SET purchaseDate = :purchaseDate, unitPrice = :unitPrice, quantity = :quantity, vendorName = :vendorName, vendorID = :vendorID WHERE purchaseID = :purchaseID';
						$updatePurchaseStatement = $conn->prepare($updatePurchase);
						$updatePurchaseStatement->execute(['purchaseDate' => $purchaseDate, 'unitPrice' => $purchaseUnitPrice, 'quantity' => $purchaseQuantity, 'vendorName' => $purchaseVendorName, 'vendorID' => $vendorID, 'purchaseID' => $purchaseID]);
						
						echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Purchase details added to database and stock values updated.</div>';
						exit();
						
					} else {
						// Item does not exist in item table, therefore, you can't update 
						// purchase details for it 
						echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Item does not exist in DB. Therefore, first enter this item to DB using the <strong>Item</strong> tab.</div>';
						exit();
					}	
					
				}
	
			} else {
				
				// PurchaseID does not exist in purchase table, therefore, you can't update it 
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Purchase details does not exist in DB for the given Purchase ID. Therefore, can\'t update.</div>';
				exit();
				
			}

		} else {
			// One or more mandatory fields are empty. Therefore, display the error message
			echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter all fields marked with a (*)</div>';
			exit();
		}
	}
?>
