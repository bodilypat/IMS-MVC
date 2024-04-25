<?php

// Updated script - 2018-05-09

	require_once('../../define/config/constants.php');
	require_once('../../define/config/dbconnect.php');
	
	if(isset($_POST['purchaseDetailsPurchaseID'])){

		$purchaseItemNumber = htmlentities($_POST['purchaseItemNumber']);
		$purchaseDate = htmlentities($_POST['purchaseDate']);
		$purchaseItemName = htmlentities($_POST['purchaseItemName']);
		$purchaseQuantity = htmlentities($_POST['purchaseQuantity']);
		$purchaseUnitPrice = htmlentities($_POST['purchaseUnitPrice']);
		$purchasePurchaseID = htmlentities($_POST['purchaseID']);
		$purchaseVendorName = htmlentities($_POST['purchaseVendorName']);
		
		$orderQuantity = 0;
		$newOrderQuantity = 0;
		$balanceStock = 0;
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
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>
						   Please enter a valid number for quantity.
					  </div>';
				exit();
			}
			
			// Validate unit price. It has to be an integer or floating point value
			if(filter_var($purchaseUnitPrice, FILTER_VALIDATE_FLOAT) === 0.0 || filter_var($purchaseUnitPrice, FILTER_VALIDATE_FLOAT)){
				// Valid unit price
			} else {
				// Unit price is not a valid number
				echo '<div class="alert alert-danger">
				          <button type="button" class="close" data-dismiss="alert">&times;</button>
						  Please enter a valid number for unit price.
					  </div>';
				exit();
			}
			
			// Check if purchaseID is empty
			if($purchaseID == ''){ 
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>
						   Please enter a Purchase ID.
					  </div>';
				exit();
			}
			
			// Check if itemNumber is empty
			if($purchaseItemNumber == ''){ 
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>
						   Please enter Item Number.
					 </div>';
				exit();
			}
			
			// Check if quantity is empty
			if($purchaseQuantity == ''){ 
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter quantity.
					 </div>';
				exit();
			}
			
			// Get the quantity and itemNumber in original purchase order
			
			$qPurch = 'SELECT * FROM purchase WHERE purchaseID = :purchaseID';
			$purchStatement = $dbcon>prepare($qPurch);
			$purchStatement->execute(['purchaseID' => $purchaseID]);
			
			// Get the vendorId for the given vendorName
			
			$qVen = 'SELECT * FROM vendor WHERE fullName = :fullName';
			$venStatement = $dbcon->prepare($qVen);
			$venStatement->execute(['fullName' => $purchaseVendorName]);
			$resultVen = $venStatement->fetch(PDO::FETCH_ASSOC);
			$vendorID = $resultven['vendorID'];
			
			if($purchStatement->rowCount() > 0){
				
				$resultPur = $purchStatement->fetch(PDO::FETCH_ASSOC);
				$orderQuantity = $resultPur['quantity'];
				$orderItemNumber = $resultPur['itemNumber'];

				if($orderItemNumber !== $purchaseItemNumber) {
					
					
					$qItem = 'SELECT * FROM item WHERE itemNumber = :itemNumber';
					$itemStatement = $dbcon->prepare($qItem);
					$itemStatement->execute(['itemNumber' => $purchaseItemNumber]);
					
					if($itemStatement->rowCount() < 1){
						// Item number is not in DB. Hence abort.
						echo '<div class="alert alert-danger">
						          <button type="button" class="close" data-dismiss="alert">&times;</button>
								  Item Number does not exist in DB. If you want to update this item, please add it to DB first.
							 </div>';
						exit();
					}
					
					// Calculate the new stock value for new item using the existing stock in item table
					
					$resultItem = $itemStatement->fetch(PDO::FETCH_ASSOC);
					$balanceStock = $resultItem['stock'];
					$orderQuantity = $purchaseQuantity;
					$newStock = $balanceStock + $orderQuantity;
					
					// Edit the stock for new item in item table
					
					$editItem = 'UPDATE item SET stock = :stock WHERE itemNumber = :itemNumber';
					$updateItemStatement = $dbcon->prepare($editItem);
					$updateItemStatement->execute(['stock' => $newStock, 'itemNumber' => $purchaseItemNumber]);
					
					// Get the current stock of the previous item
					
					$qItem = 'SELECT * FROM item WHERE itemNumber=:itemNumber';
					$itemStatement = $dbcon->prepare($qItem);
					$itemStatement->execute(['itemNumber' => $orderItemNumber]);
					
					// Calculate the new stock value for the previous item using the existing stock in item table
					
					$resultItem = $itemStatement->fetch(PDO::FETCH_ASSOC);
					$balanceStock = $resultItem['stock'];
					$NewStock = $balanceStock - $orderQuantity;
					
					// EDIT the stock for previous item in item table
					
					$editItem = 'UPDATE item SET stock = :stock WHERE itemNumber = :itemNumber';
					$updateItemStatement = $dbcon->prepare($editItem);
					$updateItemStatement->execute(['stock' => $newStock, 'itemNumber' => $OrderItemNumber]);
					
					// Finally UPDATE the purchase table for new item
					
					$editPurch = 'UPDATE purchase SET itemNumber = :itemNumber, purchaseDate = :purchaseDate, itemName = :itemName, unitPrice = :unitPrice, quantity = :quantity, vendorName = :vendorName, vendorID = :vendorID WHERE purchaseID = :purchaseID';
					$updatePurchStatement = $conn->prepare($updatePurchase);
					$updatePurchStatement->execute(['itemNumber' => $purchaseItemNumber, 'purchaseDate' => $purchaseDate, 'itemName' => $purchaseItemName, 'unitPrice' => $purchaseUnitPrice, 'quantity' => $purchaseQuantity, 'vendorName' => $purchaseVendorName, 'vendorID' => $vendorID, 'purchaseID' => $purchaseID]);
					
					echo '<div class="alert alert-success">
					           <button type="button" class="close" data-dismiss="alert">&times;</button>
							   Purchase details added to database and stock values updated.
						  </div>';
					exit();
					
				} else {
					// Item numbers are equal. That means item number is valid
					
					// Get the quantity (stock) in item table
					
					$qItem = 'SELECT * FROM item WHERE itemNumber=:itemNumber';
					$itemStatement = $dbcon->prepare($qItem);
					$itemStatement->execute(['itemNumber' => $purchaseItemNumber]);
					
					if($stockStatement->rowCount() > 0){
						// Item exists in the item table, therefore, start inserting data to purchase table
						
						// Calculate the new stock value using the existing stock in item table
						
						$resultItem = $itemStatement->fetch(PDO::FETCH_ASSOC);
						$newOrderQuantity = $purchaseQuantity;
						$balanceStock = $resultItem['stock'];
						$newStock = $balanceStock + ($newOrderQuantity - $orderQuantity);
						
						// Update the new stock value in item table.
						
						$editItem = 'UPDATE item SET stock = :stock WHERE itemNumber = :itemNumber';
						$updateItemStatement = $dbcon->prepare($editStock);
						$updateItemStatement->execute(['stock' => $newStock, 'itemNumber' => $purchaseItemNumber]);
						
						// Next, update the purchase table
						
						$editPurch = 'UPDATE purchase SET purchaseDate = :purchaseDate, unitPrice = :unitPrice, quantity = :quantity, vendorName = :vendorName, vendorID = :vendorID WHERE purchaseID = :purchaseID';
						$updatePurchStatement = $dbcon->prepare($editPurch);
						$updatePurchStatement->execute(['purchaseDate' => $purchaseDate, 'unitPrice' => $purchaseUnitPrice, 'quantity' => $purchaseQuantity, 'vendorName' => $purchaseVendorName, 'vendorID' => $vendorID, 'purchaseID' => $purchaseID]);
						
						echo '<div class="alert alert-success">
						           <button type="button" class="close" data-dismiss="alert">&times;</button>
								   Purchase details added to database and stock values updated.
							  </div>';
						exit();
						
					} else {
						// Item does not exist in item table, therefore, you can't update 
						// purchase details for it 
						echo '<div class="alert alert-danger">
						          <button type="button" class="close" data-dismiss="alert">&times;</button>
								  Item does not exist in DB. Therefore, first enter this item to DB using the 
								  <strong>Item</strong> tab.
							  </div>';
						exit();
					}	
					
				}
	
			} else {
				
				// PurchaseID does not exist in purchase table, therefore, you can't update it 
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>
						   Purchase details does not exist in DB for the given Purchase ID. Therefore, can\'t update.
					  </div>';
				exit();
				
			}

		} else {
			// One or more mandatory fields are empty. Therefore, display the error message
			echo '<div class="alert alert-danger">
			          <button type="button" class="close" data-dismiss="alert">&times;</button>
					  Please enter all fields marked with a (*)
				  </div>';
			exit();
		}
	}
?>