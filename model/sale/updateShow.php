<?php

	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');
	
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
		
		$qtyOriginalOrder = 0;
		$qtyNewOrder = 0;
		$originalStockInItemTable = 0;
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
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for Quantity.</div>';
				exit();
			}
			
			// Validate unit price. It has to be an integer or floating point value
			if(filter_var($saleUnitPrice, FILTER_VALIDATE_FLOAT) === 0.0 || filter_var($saleUnitPrice, FILTER_VALIDATE_FLOAT)){
				// Valid unit price
			} else {
				// Unit price is not a valid number
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for Unit Price.</div>';
				exit();
			}
			
			// Validate discount
			if($saleDiscount !== ''){
				if(filter_var($saleDiscount, FILTER_VALIDATE_FLOAT) === 0.0 || filter_var($saleDiscount, FILTER_VALIDATE_FLOAT)){
				// Valid discount
				} else {
					// Discount is not a valid number
					echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for Discount.</div>';
					exit();
				}
			}
			
			// Check if saleID is empty
			if($saleID == ''){ 
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a Sale ID.</div>';
				exit();
			}
			
			// Check if customerID is empty
			if($saleCustomerID == ''){ 
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a Customer ID.</div>';
				exit();
			}
			
			// Check if itemNumber is empty
			if($saleItemNumber == ''){ 
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter Item Number.</div>';
				exit();
			}
			
			// Check if quantity is empty
			if($saleQuantity == ''){ 
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter quantity.</div>';
				exit();
			}
			
			// Check if unit price is empty
			if($saleUnitPrice == ''){ 
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter Unit Price.</div>';
				exit();
			}
			
			// Get the quantity and itemNumber in original sale order
			$saleQtyQuery = 'SELECT * FROM sale WHERE saleID = :saleID';
			$saleQuantityStatement = $conn->prepare($saleQtyQuery);
			$saleQuantityStatement->execute(['saleID' => $saleID]);
			
			$customerQuery = 'SELECT * FROM customer WHERE customerID = :customerID';
			$customerIDStatement = $conn->prepare($customerQuery);
			$customerIDStatement->execute(['customerID' => $saleCustomerID]);
			
			if($customerIDStatement->rowCount() < 1){
				// Customer id is wrong
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Customer ID does not exist in DB. Please enter a valid Customer ID.</div>';
				exit();
			} else {
				$row = $customerIDStatement->fetch(PDO::FETCH_ASSOC);
				$customerID = $row['customerID'];
				$saleCustomerName = $row['fullName'];
			}
			
			if($saleQuantityStatement->rowCount() > 0){
				
				// Sale details exist in DB. Hence proceed to calculate the stock
				$originalQtyRow = $saleQuantityStatement->fetch(PDO::FETCH_ASSOC);
				$quantityInOriginalOrder = $originalQtyRow['quantity'];
				$originalOrderItemNumber = $originalQtyRow['itemNumber'];

				// Check if the user wants to update the itemNumber too. In that case,
				// we need to remove the quantity of the original order for that item and 
				// update the new item details in the item table.
				// Check if the original itemNumber is the same as the new itemNumber
				
				if($originalOrderItemNumber !== $saleItemNumber) {
					// Item numbers are different. That means the user wants to update a new item number too
					// in that case, need to update both items' stocks.
						
					// Get the stock of the new item from item table
					$newItemStock = 'SELECT * FROM item WHERE itemNumber = :itemNumber';
					$newItemCurrentStockStatement = $conn->prepare($newItemStock);
					$newItemCurrentStockStatement->execute(['itemNumber' => $saleItemNumber]);
					
					if($newItemCurrentStockStatement->rowCount() < 1){
						// Item number is not in DB. Hence abort.
						echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Item Number does not exist in DB. If you want to update this item, please add it to DB first.</div>';
						exit();
					}
					
					// Calculate the new stock value for new item using the existing stock in item table
					$newItem = $newItemCurrentStockStatement->fetch(PDO::FETCH_ASSOC);
					$originalQuantityItem = $newItem['stock'];
					$quantityNewItem = $saleDetailsQuantity;
					$newItemStock = $originalQuantityItem - $quantityNewItem;
					
					// UPDATE the stock for new item in item table
					$editItemStock = 'UPDATE item SET stock = :stock WHERE itemNumber = :itemNumber';
					$updateItemStockStatement = $conn->prepare($editItemStock);
					$updateItemStockStatement->execute(['stock' => $newItemStock, 'itemNumber' => $saleItemNumber]);
					
					// Get the current stock of the previous item
					$queryItemStock = 'SELECT * FROM item WHERE itemNumber=:itemNumber';
					$itemCurrentStockStatement = $conn->prepare($queryItemStock);
					$itemCurrentStockStatement->execute(['itemNumber' => $originalOrderItemNumber]);
					
					// Calculate the new stock value for the previous item using the existing stock in item table
					$queryItemRow = $itemCurrentStockStatement->fetch(PDO::FETCH_ASSOC);
					$quantityCurrentItem = $queryItemRow['stock'];
					$itemCurrentStock = $quantityCurrentItem + $quantityInOriginalOrder;
					
					// UPDATE the stock for previous item in item table
					$editItemStock = 'UPDATE item SET stock = :stock WHERE itemNumber = :itemNumber';
					$updateItemStockStatement = $conn->prepare($editItemStock);
					$updateItemStockUpdateStatement->execute(['stock' => $itemCurrentStock, 'itemNumber' => $originalOrderItemNumber]);
					
					// Finally UPDATE the sale table for new item
					$updateSale = 'UPDATE sale SET itemNumber = :itemNumber, saleDate = :saleDate, itemName = :itemName, unitPrice = :unitPrice, discount = :discount, quantity = :quantity, customerName = :customerName, customerID = :customerID WHERE saleID = :saleID';
					$updateSaleStatement = $conn->prepare($updateSaleDetailsSql);
					$updateSaleStatement->execute(['itemNumber' => $saleItemNumber, 'saleDate' => $saleDate, 'itemName' => $saleItemName, 'unitPrice' => $saleUnitPrice, 'discount' => $saleDiscount, 'quantity' => $saleQuantity, 'customerName' => $saleCustomerName, 'customerID' => $customerID, 'saleID' => $saleID]);
					
					echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Sale details updated.</div>';
					exit();
					
				} else {
					// Item numbers are equal. That means item number is valid
					
					// Get the quantity (stock) in item table
					$QueryStock = 'SELECT * FROM item WHERE itemNumber=:itemNumber';
					$stockStatement = $conn->prepare($queryStock);
					$stockStatement->execute(['itemNumber' => $saleItemNumber]);
					
					if($stockStatement->rowCount() > 0){
						// Item exists in the item table, therefore, start updating data in sale table
						
						// Calculate the new stock value using the existing stock in item table
						$row = $stockStatement->fetch(PDO::FETCH_ASSOC);
						$quantityNewOrder = $saleQuantity;
						$originalStockInItemTable = $row['stock'];
						$newStock = $originalStockInItemTable - ($quantityNewOrder - $quantityInOriginalOrder);
						
						// Update the new stock value in item table.
						$ediStock = 'UPDATE item SET stock = :stock WHERE itemNumber = :itemNumber';
						$updateStockStatement = $conn->prepare($editStock);
						$updateStockStatement->execute(['stock' => $newStock, 'itemNumber' => $saleItemNumber]);
						
						// Next, update the sale table
						$updateSale = 'UPDATE sale SET itemNumber = :itemNumber, saleDate = :saleDate, itemName = :itemName, unitPrice = :unitPrice, discount = :discount, quantity = :quantity, customerName = :customerName, customerID = :customerID WHERE saleID = :saleID';
						$updateSaleStatement = $conn->prepare($updateSaleDetailsSql);
						$updateSaleStatement->execute(['itemNumber' => $saleItemNumber, 'saleDate' => $saleDate, 'itemName' => $saleItemName, 'unitPrice' => $saleUnitPrice, 'discount' => $saleDiscount, 'quantity' => $saleQuantity, 'customerName' => $saleCustomerName, 'customerID' => $customerID, 'saleID' => $saleID]);
						
						echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Sale details updated.</div>';
						exit();
						
					} else {
						// Item does not exist in item table, therefore, you can't update 
						// sale details for it 
						echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Item does not exist in DB. Therefore, first enter this item to DB using the <strong>Item</strong> tab.</div>';
						exit();
					}	
					
				}
	
			} else {
				
				// SaleID does not exist in purchase table, therefore, you can't update it 
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Sale details does not exist in DB for the given Sale ID. Therefore, can\'t update.</div>';
				exit();
				
			}

		} else {
			// One or more mandatory fields are empty. Therefore, display the error message
			echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter all fields marked with a (*)</div>';
			exit();
		}
	}
?>
    
