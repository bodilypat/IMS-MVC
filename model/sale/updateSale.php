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
		
		/* check mandatory fields does not empty */
		if(isset($saleItemNumber) && isset($saleDate) && isset($saleQuantity) && isset($saleUnitPrice) && isset($saleCustomerID)){
		
			/* Sanitize itemNumber */
			$saleItemNumber = filter_var($saleItemNumber, FILTER_SANITIZE_STRING);
			
			/* validate itemQuantity */
			if(filter_var($saleQuantity, FILTER_VALIDATE_INT) === 0 || filter_var($saleQuantity, FILTER_VALIDATE_INT)){
		
				/* quantity is valie */
			} else {
			
				/* quantity invalie */
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>
					        Please enter a valid number for Quantity.
					</div>';
				exit();
			}
			
			/* validate unitPrice  */
			if(filter_var($saleUnitPrice, FILTER_VALIDATE_FLOAT) === 0.0 || filter_var($saleUnitPrice, FILTER_VALIDATE_FLOAT)){
			
				/* valid unitPrice */
			} else {
				
				/* unitPrice invalid */
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>
						   Please enter a valid number for Unit Price.
					 </div>';
				exit();
			}
			
			/* validate discount */
			if($saleDiscount !== ''){
				if(filter_var($saleDiscount, FILTER_VALIDATE_FLOAT) === 0.0 || filter_var($saleDiscount, FILTER_VALIDATE_FLOAT)){
			
				/* discount valid */
				} else {
	
					/* discount invalid */
					echo '<div class="alert alert-danger">
							   <button type="button" class="close" data-dismiss="alert">&times;</button>
							   Please enter a valid number for Discount.
						  </div>';
					exit();
				}
			}
			
			/* check saleID empty */
			if($saleID == ''){ 
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>
						   Please enter a Sale ID.
					 </div>';
				exit();
			}
			
			/* check customerID empty */
			if($saleCustomerID == ''){ 
				echo '<div class="alert alert-danger">
				          <button type="button" class="close" data-dismiss="alert">&times;</button>
						  Please enter a Customer ID.
					 </div>';
				exit();
			}
			
			/* check itemNumber is empty */
			if($saleItemNumber == ''){ 
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>
						   Please enter Item Number.
					 </div>';
				exit();
			}
			
			/* check quantity is empty */
			if($saleQuantity == ''){ 
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>
						   Please enter quantity.
					  </div>';
				exit();
			}
			
			/* check unitPrice empty */
			if($saleUnitPrice == ''){ 
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>
						   Please enter Unit Price.
					  </div>';
				exit();
			}
			
			/* query sale object from DB  */
			$qSale = " SELECT * FROM sale WHERE saleID = '$saleID'";
			$saleStatement = $dbcon->prepare($qSale);
			$saleStatement->execute(['saleID' => $saleID]);
			
			/* query customer object from DB */
			$qCust = " SELECT * FROM customer WHERE customerID = '$customerID'";
			$custStatement = $dbcon->prepare($qCust);
			$custStatement->execute(['customerID' => $saleCustomerID]);
			
			if($custStatement->rowCount() < 1){
				/* customerID is invalid */
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
				
				/* get quantity , itemNuber from sale object */
				$resultSale = $saleStatement->fetch(PDO::FETCH_ASSOC);
				$orderQuantity = $resultSale['quantity'];
				$orderItemNumber = $resultSale['itemNumber'];
				
				/* compare itemNumber in DB with saleItemNumber */
				if($orderItemNumber !== $saleItemNumber) {
					
					$qItem = "SELECT * FROM item WHERE itemNumber = '$saleItemNumber'";
					$itemStatement = $dbcon->prepare($qItem);
					$itemStatement->execute(['itemNumber' => $saleItemNumber]);
					
					if($itemStatement->rowCount() < 1){

						/* itemNumaber does not exist in DB  */
						echo '<div class="alert alert-danger">
						           <button type="button" class="close" data-dismiss="alert">&times;</button>
								   Item Number does not exist in DB. If you want to update this item, please add it to DB first.
							  </div>';
						exit();
					}
					
					/* calculate new stock  */
					$resultItem = $itemStatement->fetch(PDO::FETCH_ASSOC);
					$orderQuantity = $resultItem['stock'];
					$newOrderQuantity = $saleQuantity; /* olderOrder - newOrder */
					$newStock = $orderQuantity - $newOrderQuantity;
					
					/* update item table */
					$editItem = 'UPDATE item SET stock = :stock WHERE itemNumber = :itemNumber';
					$updateItemStatement = $dbcon->prepare($editItem);
					$updateItemStatement->execute(['stock' => $newStock, 'itemNumber' => $saleItemNumber]);
					
					
					/* query current stock form item object */
					$qItem = "SELECT * FROM item WHERE itemNumber='$orderItemNumber'";
					$itemStatement = $dbcon->prepare($qItem);
					$itemStatement->execute(['itemNumber' => $orderItemNumber]);
					
					/* calculate new stock */
					$resultItem = $itemStatement->fetch(PDO::FETCH_ASSOC);
					$balanceStock = $resultItem['stock'];
					$newStock = $balanceStock + $orderQuantity;
					
					/* update item table */
					$editItemStock = "UPDATE item SET stock = '$newStock WHERE itemNumber = '$orderItemNumber'";
					$updateItemStatement = $dbcon->prepare($editItemStock);
					$updateItemStatement->execute(['stock' => $newStock, 'itemNumber' => $orderItemNumber]);
					
					/* update sale table */
					$editSale = "UPDATE sale SET itemNumber = '$saleItemNumber', 
					                             saleDate = '$saleDate', 
												 itemName = '$saleItemName', 
												 unitPrice = '$saleUnitPrice', 
												 discount = '$saleDiscount', 
												 quantity = '$saleQuantity', 
												 customerName = '$saleCustomerName', 
												 customerID = '$saleCustomerID'
											WHERE saleID = '$saleID' ";
					$updateSaleStatement = $dbcon->prepare($editSale);
					$updateSaleStatement->execute(['itemNumber' => $saleItemNumber, 
					                               'saleDate' => $saleDate, 
												   'itemName' => $saleItemName, 
												   'unitPrice' => $saleUnitPrice, 
												   'discount' => $saleDiscount, 
												   'quantity' => $saleQuantity, 
												   'customerName' => $saleCustomerName, 
												   'customerID' => $customerID, 
												   'saleID' => $saleID]);
					
					echo '<div class="alert alert-success">
					           <button type="button" class="close" data-dismiss="alert">&times;</button>
							    Sale details updated.
						  </div>';
					exit();
					
				} else {
					
					/* itemNumber equal, itemNumber is valie */
					/* get quantity from item object */
					$qItem = " SELECT * FROM item WHERE itemNumber='$saleItemNumber'";
					$itemStatement = $dbcon->prepare($qItem);
					$itemStatement->execute(['itemNumber' => $saleItemNumber]);
					
					if($itemStatement->rowCount() > 0){

						/* itemNumber exists in database, start update in sale */
						/* calculate newStock using stock in DB */
						$resultItem = $itemStatement->fetch(PDO::FETCH_ASSOC);
						$newOrderQuantity = $saleQuantity;
						$balanceStock = $resultItem['stock'];
						$newStock = $balanceStock - ($newOrderQuantity - $orderQuantity);
						
						/* update newStock into database */
						$editItem = " UPDATE item SET stock = :stock WHERE itemNumber = '$saleItemNumber'";
						$updateItemStatement = $dbcon->prepare($editItem);
						$updateItemStatement->execute(['stock' => $newStock, 'itemNumber' => $saleItemNumber]);
					
						/* update sale */
						$editSale = "UPDATE sale SET itemNumber = '$saleItemNumber', 
						                             saleDate = '$saleDate', 
													 itemName = '$saleItemName', 
													 unitPrice = '$saleUnitPrice', 
													 discount = '$saleDiscount', 
													 quantity = '$saleQuantity', 
													 customerName = '$saleCustomerName', 
													 customerID = '$saleCustomerID' 
												WHERE saleID = '$saleID' ";
						$updateSaleStatement = $dbcon->prepare($editSale);
						$updateSaleStatement->execute(['itemNumber' => $saleItemNumber, 
						                               'saleDate' => $saleDate, 
													   'itemName' => $saleItemName, 
													   'unitPrice' => $saleUnitPrice, 
													   'discount' => $saleDiscount, 
													   'quantity' => $saleQuantity, 
													   'customerName' => $saleCustomerName, 
													   'customerID' => $customerID, 
													   'saleID' => $saleID]);
						
						echo '<div class="alert alert-success">
						          <button type="button" class="close" data-dismiss="alert">&times;</button>
								  Sale details updated.
							  </div>';
						exit();
						
					} else {
						
						/* itemNumber does not exits in item , cannot update */
						echo '<div class="alert alert-danger">
						          <button type="button" class="close" data-dismiss="alert">&times;</button>
								  Item does not exist in DB. Therefore, first enter this item to DB using the 
								  <strong>Item</strong> tab.
							  </div>';
						exit();
					}	
					
				}
	
			} else {
				
				/* saleID does not exist in purchase , cannot upt */
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>
						   Sale details does not exist in DB for the given Sale ID. Therefore, can\'t update.
					 </div>';
				exit();
				
			}

		} else {
			/* mandarory fields empty , display error message */
			echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter all fields marked with a (*)</div>';
			exit();
		}
	}
?>