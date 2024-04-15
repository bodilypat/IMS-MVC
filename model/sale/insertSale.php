<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/dbconnect.php');
	
	if(isset($_POST['saleItemNumber'])){
		
		$saleItemNumber = htmlentities($_POST['saleItemNumber']);
		$saleItemName = htmlentities($_POST['saleItemName']);
		$saleDiscount = htmlentities($_POST['saleDiscount']);
		$saleQuantity = htmlentities($_POST['saleQuantity']);
		$saleUnitPrice = htmlentities($_POST['saleUnitPrice']);
		$saleCustomerID = htmlentities($_POST['saleCustID']);
		$saleCustomerName = htmlentities($_POST['saleCustName']);
		$saleDate = htmlentities($_POST['saleDate']);
		
		$balanceStock = 0;
		$newStock= 0;
		
		/* Check  mandatory fields are not empty */
		if(!empty($itemNumber) && isset($itemCustomerID) && isset($itemSaleDate) && isset($itemQuantity) && isset($itemUnitPrice)){
			
			/*  Sanitize item number */
			$itemNumber = filter_var($itemNumber, FILTER_SANITIZE_STRING);
			
			/* Validate item quantity. It has to be a number */
			if(filter_var($itemQuantity, FILTER_VALIDATE_INT) === 0 || filter_var($itemQuantity, FILTER_VALIDATE_INT)){
				
			} else {
				
				echo '<div class="alert alert-danger">
				          <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for quantity
					  </div>';
				exit();
			}
			
			if($itemCustomerID == ''){ 
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a Customer ID.
					  </div>';
				exit();
			}
			
			if(filter_var($itemCustomerID, FILTER_VALIDATE_INT) === 0 || filter_var($itemCustomerID, FILTER_VALIDATE_INT)){
			} else {
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid Customer ID
					  </div>';
				exit();
			}
			
			if($itemNumber == ''){ 
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter Item Number.
					  </div>';
				exit();
			}
			
			if($itemUnitPrice == ''){ 
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter Unit Price.
					  </div>';
				exit();
			}

			if(filter_var($itemUnitPrice, FILTER_VALIDATE_FLOAT) === 0.0 || filter_var($itemUnitPrice, FILTER_VALIDATE_FLOAT)){
			} else {
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for unit price
					  </div>';
				exit();
			}
			
			/* Validate discount  if it's provided */
			if(!empty($itemDiscount)){
				if(filter_var($itemDiscount, FILTER_VALIDATE_FLOAT) === false){					
					echo '<div class="alert alert-danger">
					           <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid discount amount
						 </div>';
					exit();
				}
			}

			// get stock from item
			$qItem = 'SELECT stock FROM item WHERE itemNumber = :itemNumber';
			$itemStatement = $dbcon->prepare($qItem);
			$itemStatement->execute(['itemNumber' => $itemNumber]);

			if($itemStatement->rowCount() > 0){			
				$resultItem = $itemStatement->fetch(PDO::FETCH_ASSOC);
				$balanceStock = $resultItem['stock'];
				
				if($balanceStock <= 0) {
					echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Stock is empty. Therefore, can\'t make a sale. Please select a different item.</div>';
					exit();
				} elseif ($balanceStock < $saleQuantity) { 
					echo '<div class="alert alert-danger">
					           <button type="button" class="close" data-dismiss="alert">&times;</button>Not enough stock available for this sale. Therefore, can\'t make a sale. Please select a different item.
						   </div>';
					exit();
				}
				else {
					$newStock = $balanceStock - $saleQuantity;
					
					/* Check if the customer is in DB
 */					$qCust = 'SELECT * FROM customer WHERE customerID = :customerID';
					$custStatement = $dbcon->prepare($qCust);
					$custStatement->execute(['customerID' => $customerID]);
					
					if($custStatement->rowCount() > 0){
						/* Customer exits. That means both customer, item, and stocks are available. Hence start INSERT and UPDATE */
						$resultCust = $custStatement->fetch(PDO::FETCH_ASSOC);
						$customerName = $resultCust['fullName'];
						
						/* INSERT data to sale table */
						$addSale = 'INSERT INTO sale(itemNumber, itemName, discount, quantity, unitPrice, customerID, customerName, saleDate) 
						            ALUES(:itemNumber, :itemName, :discount, :quantity, :unitPrice, :customerID, :customerName, :saleDate)';
						$saleStatement = $dbcon->prepare($addSale);
						$saleStatement->execute(['itemNumber' => $itemNumber, 
						                         'itemName' => $itemName, 
												 'discount' => $discount, 
												 'quantity' => $quantity, 
												 'unitPrice' => $unitPrice, 
												 'customerID' => $customerID, 
												 'customerName' => $customerName, 
												 'saleDate' => $saleDate]);
						
						/*  UPDATE the stock in item table */
						$editItem = 'UPDATE item SET stock = :stock WHERE itemNumber = :itemNumber';
						$itemStatement = $dbcon->prepare($editItem);
						$itemStatement->execute(['stock' => $newStock, 'itemNumber' => $itemNumber]);
						
						echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Sale details added to DB and stocks updated.</div>';
						exit();
						
					} else {
						echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Customer does not exist.</div>';
						exit();
					}
				}
				
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Item already exists in DB. Please click the <strong>Update</strong> button to update the details. Or use a different Item Number.</div>';
				exit();
			} else {
				/* Item does not exist, can't make a sale from it */
				echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Item does not exist in DB.</div>';
				exit();
			}

		} else {
			/*  One or more mandatory fields are empty. display a the error message */
			echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter all fields marked with a (*)</div>';
			exit();
		}
	}
?>