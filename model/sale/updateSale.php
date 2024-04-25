<?php

	require_once('../../define/config/constants.php');
	require_once('../../define/config/db.php');
	
	if(isset($_POST['saleID'])){

		$saleItemNumber = htmlentities($_POST['saleItemNumber']);
		$saleDate = htmlentities($_POST['saleDate']);
		$saleItemName = htmlentities($_POST['saleItemName']);
		$saleQuantity = htmlentities($_POST['saleQuantity']);
		$saleUnitPrice = htmlentities($_POST['saleUnitPrice']);
		$saleID = htmlentities($_POST['saleID']);
		$saleCustomerName = htmlentities($_POST['saleCustName']);
		$saleDiscount = htmlentities($_POST['saleDiscount']);
		$saleCustomerID = htmlentities($_POST['saleCustID']);
		
		$orderQuantity = 0;
		$newOrderQuantity = 0;
		$balanceStock = 0;
		$newStock = 0;
		
		// Check if mandatory fields are not empty
		if(isset($saleItemNumber) && isset($saleDate) && isset($saleQuantity) && isset($saleUnitPrice) && isset($saleCustomerID)){
			
			// Sanitize item number
			$saleItemNumber = filter_var($saleItemNumber, FILTER_SANITIZE_STRING);
			
			// Validate item quantity. It has to be an integer
			if(filter_var($saleQuantity, FILTER_VALIDATE_INT) === 0 || filter_var($saleQuantity, FILTER_VALIDATE_INT)){
				// Quantity is valid
			} else {
				// Quantity is not a valid number
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>
					        Please enter a valid number for Quantity.
					</div>';
				exit();
			}
			
			// Validate unit price. It has to be an integer or floating point value
			if(filter_var($saleUnitPrice, FILTER_VALIDATE_FLOAT) === 0.0 || filter_var($saleUnitPrice, FILTER_VALIDATE_FLOAT)){
				// Valid unit price
			} else {
				// Unit price is not a valid number
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>
						   Please enter a valid number for Unit Price.
					 </div>';
				exit();
			}
			
			// Validate discount
			if($saleDiscount !== ''){
				if(filter_var($saleDiscount, FILTER_VALIDATE_FLOAT) === 0.0 || filter_var($saleDiscount, FILTER_VALIDATE_FLOAT)){
				// Valid discount
				} else {
					// Discount is not a valid number
					echo '<div class="alert alert-danger">
							   <button type="button" class="close" data-dismiss="alert">&times;</button>
							   Please enter a valid number for Discount.
						  </div>';
					exit();
				}
			}
			
			// Check if saleID is empty
			if($saleID == ''){ 
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>
						   Please enter a Sale ID.
					 </div>';
				exit();
			}
			
			// Check if customerID is empty
			if($saleCustomerID == ''){ 
				echo '<div class="alert alert-danger">
				          <button type="button" class="close" data-dismiss="alert">&times;</button>
						  Please enter a Customer ID.
					 </div>';
				exit();
			}
			
			// Check if itemNumber is empty
			if($saleItemNumber == ''){ 
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>
						   Please enter Item Number.
					 </div>';
				exit();
			}
			
			// Check if quantity is empty
			if($saleQuantity == ''){ 
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>
						   Please enter quantity.
					  </div>';
				exit();
			}
			
			// Check if unit price is empty
			if($saleUnitPrice == ''){ 
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>
						   Please enter Unit Price.
					  </div>';
				exit();
			}
			
			
			/* query sale record  */
			$qSale = 'SELECT * FROM sale WHERE saleID = :saleID';
			$saleStatement = $dbcon->prepare($qSale);
			$saleStatement->execute(['saleID' => $saleID]);
			
			/* query customer record  */
			$qCust = 'SELECT * FROM customer WHERE customerID = :customerID';
			$custStatement = $dbcon->prepare($qCust);
			$custStatement->execute(['customerID' => $saleCustomerID]);
			
			if($custStatement->rowCount() < 1){
				// Customer id is wrong
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>
						    Customer ID does not exist in DB. Please enter a valid Customer ID.
					  </div>';
				exit();
			} else {
				$resultCust = $custStatement->fetch(PDO::FETCH_ASSOC);
				$customerID = $resultCust['customerID'];
				$customerName = $resultCust['fullName'];
			}
			
			if($saleStatement->rowCount() > 0){
				
				// sale record
				$resultSale = $saleStatement->fetch(PDO::FETCH_ASSOC);
				$orderQuantity = $resultSale['quantity'];
				$orderItemNumber = $resultSale['itemNumber'];
				
				/* compare itemNumber in DB with saleItemNumber */
				if($orderItemNumber !== $saleItemNumber) {
					
					$qItem = 'SELECT * FROM item WHERE itemNumber = :itemNumber';
					$itemStatement = $dbcon->prepare($qItem);
					$itemStatement->execute(['itemNumber' => $saleItemNumber]);
					
					if($itemStatement->rowCount() < 1){

						/* item number is not in DB  */
						echo '<div class="alert alert-danger">
						           <button type="button" class="close" data-dismiss="alert">&times;</button>
								   Item Number does not exist in DB. If you want to update this item, please add it to DB first.
							  </div>';
						exit();
					}
					
					/* calculate new stock  */
					$resultItem = $itemStatement->fetch(PDO::FETCH_ASSOC);
					$orderQuantity = $resultItem['stock'];
					$newOrderQuantity = $saleQuantity;
					$newStock = $orderQuantity - $newOrderQuantity;
					
					/* update item table */
					$editItem = 'UPDATE item SET stock = :stock WHERE itemNumber = :itemNumber';
					$updateItemStatement = $dbcon->prepare($editItem);
					$updateItemStatement->execute(['stock' => $newStock, 'itemNumber' => $saleItemNumber]);
					
					
					/* query current stock */
					$qItem = 'SELECT * FROM item WHERE itemNumber=:itemNumber';
					$itemStatement = $dbcon->prepare($qItem);
					$itemStatement->execute(['itemNumber' => $orderItemNumber]);
					
					/* calculate new stock */
					$resultItem = $itemStatement->fetch(PDO::FETCH_ASSOC);
					$balanceStock = $resultItem['stock'];
					$currentStock = $balanceStock + $newOrderQuantity;
					
					/* update item table */
					$editItemStock = 'UPDATE item SET stock = :stock WHERE itemNumber = :itemNumber';
					$updateItemStatement = $dbcon->prepare($editItemStock);
					$updateItemStatement->execute(['stock' => $currentStock, 'itemNumber' => $orderItemNumber]);
					
					/* update sale table */
					$editSale = 'UPDATE sale SET itemNumber = :itemNumber, saleDate = :saleDate, itemName = :itemName, unitPrice = :unitPrice, discount = :discount, quantity = :quantity, customerName = :customerName, customerID = :customerID WHERE saleID = :saleID';
					$updateSaleStatement = $dbcon->prepare($editSale);
					$updateSaleStatement->execute(['itemNumber' => $saleItemNumber, 'saleDate' => $saleDate, 'itemName' => $saleItemName, 'unitPrice' => $saleUnitPrice, 'discount' => $saleDiscount, 'quantity' => $saleQuantity, 'customerName' => $saleCustomerName, 'customerID' => $customerID, 'saleID' => $saleID]);
					
					echo '<div class="alert alert-success">
					           <button type="button" class="close" data-dismiss="alert">&times;</button>
							    Sale details updated.
						  </div>';
					exit();
					
				} else {
					// Item numbers are equal. That means item number is valid
					
					// Get the quantity (stock) in item table
					$qItem = 'SELECT * FROM item WHERE itemNumber=:itemNumber';
					$itemStatement = $dbcon->prepare($qItem);
					$itemStatement->execute(['itemNumber' => $saleItemNumber]);
					
					if($itemStatement->rowCount() > 0){
						// Item exists in the item table, therefore, start updating data in sale table
						
						// Calculate the new stock value using the existing stock in item table
						$resultItem = $itemStatement->fetch(PDO::FETCH_ASSOC);
						$newOrderQuantity = $saleQuantity;
						$balanceStock = $resultItem['stock'];
						$newStock = $balanceStock - ($newOrderQuantity - $orderQuantity);
						
						// Update the new stock value in item table.
						$editItem = 'UPDATE item SET stock = :stock WHERE itemNumber = :itemNumber';
						$updateItemStatement = $dbconn->prepare($editItem);
						$updateItemStatement->execute(['stock' => $newStock, 'itemNumber' => $saleItemNumber]);
						
						// Next, update the sale table
						$editSale = 'UPDATE sale SET itemNumber = :itemNumber, saleDate = :saleDate, itemName = :itemName, unitPrice = :unitPrice, discount = :discount, quantity = :quantity, customerName = :customerName, customerID = :customerID WHERE saleID = :saleID';
						$updateSaleStatement = $dbcon->prepare($editSale);
						$updateSaleStatement->execute(['itemNumber' => $saleItemNumber, 'saleDate' => $saleDate, 'itemName' => $saleItemName, 'unitPrice' => $saleUnitPrice, 'discount' => $saleDiscount, 'quantity' => $saleQuantity, 'customerName' => $saleCustomerName, 'customerID' => $customerID, 'saleID' => $saleID]);
						
						echo '<div class="alert alert-success">
						          <button type="button" class="close" data-dismiss="alert">&times;</button>
								  Sale details updated.
							  </div>';
						exit();
						
					} else {
						// Item does not exist in item table, therefore, you can't update 
						// sale details for it 
						echo '<div class="alert alert-danger">
						          <button type="button" class="close" data-dismiss="alert">&times;</button>
								  Item does not exist in DB. Therefore, first enter this item to DB using the 
								  <strong>Item</strong> tab.
							  </div>';
						exit();
					}	
					
				}
	
			} else {
				
				// SaleID does not exist in purchase table, therefore, you can't update it 
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>
						   Sale details does not exist in DB for the given Sale ID. Therefore, can\'t update.
					 </div>';
				exit();
				
			}

		} else {
			// One or more mandatory fields are empty. Therefore, display the error message
			echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter all fields marked with a (*)</div>';
			exit();
		}
	}
?>