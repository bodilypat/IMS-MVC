<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/dbconnect.php');
	
	if(isset($_POST['saleItemNumber'])){
		
		$saleItemNumber = htmlentities($_POST['saleItemNumber']);
		$saleItemName = htmlentities($_POST['saleItemName']);
		$saleDiscount = htmlentities($_POST['saleDiscount']);
		$saleQuantity = htmlentities($_POST['saleQuantity']);
		$saleUnitPrice = htmlentities($_POST['saleUnitPrice']);
		$saleCustomerID = htmlentities($_POST['saleCustomerID']);
		$saleCustomerName = htmlentities($_POST['saleCustomerName']);
		$saleDate = htmlentities($_POST['saleDate']);
		
		$balanceStock = 0;
		$newStock= 0;
		
		/* Check  mandatory fields are not empty */
		if(!empty($saleItemNumber) && isset($saleCustomerID) && isset($SaleDate) && isset($saleQuantity) && isset($saleUnitPrice)){
			
			/*  Sanitize item number */
			$saleItemNumber = filter_var($saleItemNumber, FILTER_SANITIZE_STRING);
			
			/* Validate item quantity. It has to be a number */
			if(filter_var($saleQuantity, FILTER_VALIDATE_INT) === 0 || filter_var($saleQuantity, FILTER_VALIDATE_INT)){
				
			} else {
				
				echo '<div class="alert alert-danger">
				          <button type="button" class="close" data-dismiss="alert">&times;</button>
						  Please enter a valid number for quantity
					  </div>';
				exit();
			}
			
			if($saleCustomerID == ''){ 
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>
						   Please enter a Customer ID.
					  </div>';
				exit();
			}
			
			if(filter_var($saleCustomerID, FILTER_VALIDATE_INT) === 0 || filter_var($saleCustomerID, FILTER_VALIDATE_INT)){
			} else {
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>
						   Please enter a valid Customer ID
					  </div>';
				exit();
			}
			
			if($saleItemNumber == ''){ 
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>
						   Please enter Item Number.
					  </div>';
				exit();
			}
			
			if($itemUnitPrice == ''){ 
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter Unit Price.
					  </div>';
				exit();
			}

			if(filter_var($saleUnitPrice, FILTER_VALIDATE_FLOAT) === 0.0 || filter_var($saleUnitPrice, FILTER_VALIDATE_FLOAT)){
			} else {
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>
						   Please enter a valid number for unit price
					  </div>';
				exit();
			}
			
			/* Validate discount  if it's provided */
			if(!empty($saleDiscount)){
				if(filter_var($saleDiscount, FILTER_VALIDATE_FLOAT) === false){					
					echo '<div class="alert alert-danger">
					           <button type="button" class="close" data-dismiss="alert">&times;</button>
							   Please enter a valid discount amount
						 </div>';
					exit();
				}
			}

			/* get object item form database */
			$qItem = "SELECT stock FROM item WHERE itemNumber = '$saleItemNumber'";
			$itemStatement = $dbcon->prepare($qItem);
			$itemStatement->execute(['itemNumber' => $saleItemNumber]);

			/* get item stock */
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
					/* balanceStock > 0 */
					$newStock = $balanceStock - $saleQuantity;
					
					/* get customer object from database */
    				$qCust = "SELECT * FROM customer WHERE customerID = '$SalecustomerID'";
					$custStatement = $dbcon->prepare($qCust);
					$custStatement->execute(['customerID' => $saleCustomerID]);
					
					if($custStatement->rowCount() > 0){
						/* get customer name */
						$resultCust = $custStatement->fetch(PDO::FETCH_ASSOC);
						$customerName = $resultCust['fullName'];
						
						/* add sale object int database  */
						$addSale = "INSERT INTO sale(itemNumber, itemName, discount, quantity, unitPrice, customerID, customerName, saleDate) 
						            VALUES('$saleItemNumber', '$saleItemName', '$saleDiscount','$saleQuantity','$saleUnitPrice','$saleCustomerID','$saleCustomerName','$saleDate')";
						$saleStatement = $dbcon->prepare($addSale);
						$saleStatement->execute(['itemNumber' => $saleItemNumber, 
						                         'itemName' => $saleItemName, 
												 'discount' => $saleDiscount, 
												 'quantity' => $saleQuantity, 
												 'unitPrice' => $saleUnitPrice, 
												 'customerID' => $saleCustomerID, 
												 'customerName' => $saleCustomerName, 
												 'saleDate' => $saleDate]);
						
						/*  UPDATE the stock to item in database */
						$editItem = "UPDATE item SET stock = '$newStock' WHERE itemNumber = '$saleItemNumber'";
						$itemStatement = $dbcon->prepare($editItem);
						$itemStatement->execute(['stock' => $newStock, 'itemNumber' => $saleItemNumber]);
						
						echo '<div class="alert alert-success">
						           <button type="button" class="close" data-dismiss="alert">&times;</button>
								   Sale details added to DB and stocks updated.
							 </div>';
						exit();
						
					} else {
						echo '<div class="alert alert-danger">
						          <button type="button" class="close" data-dismiss="alert">&times;</button>
							      Customer does not exist.
							  </div>';
						exit();
					}
				}
				
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>
						   Item already exists in DB. Please click the <strong>Update</strong> 
						   button to update the details. Or use a different Item Number.
					 </div>';
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