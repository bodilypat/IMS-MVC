<?php

	require_once('../../include/config/constants.php');
	require_once('../../include/config/dbconnect.php');
	
	if(isset($_POST['purchaseDetailsPurchaseID'])){

		$purchItemNumber = htmlentities($_POST['purchaseItemNumber']);
		$purchDate = htmlentities($_POST['purchaseDate']);
		$purchItemName = htmlentities($_POST['purchaseItemName']);
		$purchQuantity = htmlentities($_POST['purchaseQuantity']);
		$purchUnitPrice = htmlentities($_POST['purchaseUnitPrice']);
		$purchID = htmlentities($_POST['purchaseID']);
		$purchVendorName = htmlentities($_POST['purchaseVendorName']);
		
		$previousOrderQuantity = 0;
		$orderQuantity = 0;
		$balanceStock = 0;
		$newStock = 0;
		$orderItemNumber = '';
		
		/*  Check if mandatory fields are not empty */
		if(isset($purchItemNumber) && isset($purchDate) && isset($purchQuantity) && isset($purchUnitPrice)){
			
			/* Sanitize item number */
			$purchItemNumber = filter_var($purchItemNumber, FILTER_SANITIZE_STRING);
			
			/*  Validate item quantity. It has to be an integer */
			if(filter_var($purchQuantity, FILTER_VALIDATE_INT) === 0 || filter_var($purchQuantity, FILTER_VALIDATE_INT)){				
			} else {				
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for quantity.</div>';
				exit();
			}

			if(filter_var($purchUnitPrice, FILTER_VALIDATE_FLOAT) === 0.0 || filter_var($purchUnitPrice, FILTER_VALIDATE_FLOAT)){
			} else {	
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for unit price.
					  </div>';
				exit();
			}
			
			if($purchID == ''){ 
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a Purchase ID.
					  </div>';
				exit();
			}
			
			if($purchItemNumber == ''){ 
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter Item Number.
					  </div>';
				exit();
			}
			
			if($purchQuantity == ''){ 
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter quantity.
					 </div>';
				exit();
			}
			
			$qPurch = 'SELECT * FROM purchase WHERE purchaseID = :purchID';
			$purchStatement = $dbcon->prepare($qPurch);
			$purchStatement->execute(['purchaseID' => $purchID]);
			
			/* Get the vendorId for the given vendorName */
			
			$qVen = 'SELECT * FROM vendor WHERE fullName = :fullName';
			$venStatement = $dbcon->prepare($qVen);
			$venStatement->execute(['fullName' => $purchVendorName]);

			$resultVen = $venStatement->fetch(PDO::FETCH_ASSOC);
			$vendorID = $resultVen['vendorID'];
			
			if($purchStatement->rowCount() > 0){
				
				/* Purchase details exist in DB. Hence proceed to calculate the stock */
				$resultPur = $purchStatement->fetch(PDO::FETCH_ASSOC);
				$orderQuantity = $resultPur['quantity'];
				$orderItemNumber = $resultPur['itemNumber'];

				/* 	Check if the original itemNumber is the same as the new itemNumber */
				if($orderItemNumber !== $purchItemNumber) {

					$qItem = 'SELECT * FROM item WHERE itemNumber = :purchItemNumber';
					$itemStatement = $dbcon->prepare($qItem);
					$itemStatement->execute(['itemNumber' => $purchItemNumber]);
					
					if($itemStatement->rowCount() < 1){
						
						echo '<div class="alert alert-danger">
						          <button type="button" class="close" data-dismiss="alert">&times;</button>Item Number does not exist in DB. If you want to update this item, please add it to DB first.
							  </div>';
						exit();
					}
					
					/* Calculate the new stock value for new item using the existing stock in item table */	
					$resultItem = $itemStatement->fetch(PDO::FETCH_ASSOC);
					$balanceStock = $resultItem['stock'];
					$orderQuantity = $purchQuantity;
					$newStock = $balanceStock + $orderQuatity;
					
					/*  Edit the stock for new item in item table */
					
					$editItem = 'UPDATE item SET stock = :stock WHERE itemNumber = :purchItemNumber';
					$itemStatement = $dbcon->prepare($editItem);
					$itemStatement->execute(['stock' => $newStock, 'itemNumber' => $purchItemNumber]);
					
					/* Get the current stock of the previous item */
					
					$qItem = 'SELECT * FROM item WHERE itemNumber=:purchItemNumber';
					$itemStatement = $dbcon->prepare($qItem);
					$itemStatement->execute(['itemNumber' => $purchItemNumber]);
					
					/* Calculate the new stock value for the previous item using the existing stock in item table */
					
					$resultItem = $itemStatement->fetch(PDO::FETCH_ASSOC);
					$balanceStock = $resultItem['stock'];
					$newStock = $balanceStock - $orderQuantity;
					
					/* EDIT the stock for previous item in item table */
					
					$editItem = 'UPDATE item SET stock = :stock WHERE itemNumber = :purchItemNumber';
					$itemStatement = $conn->prepare($editStock);
					$itemStatement->execute(['stock' => $newStock, 'itemNumber' => $purchItemNumber]);
					
					/*  Finally UPDATE the purchase table for new item */
					
					$editPur = 'UPDATE purchase SET itemNumber = :purchItemNumber, 
					                                purchaseDate = :purchDate, 
													itemName = :purchItemName, 
													unitPrice = :purchUnitPrice, 
													quantity = :purchQuantity, 
													vendorName = :purchVendorName, 
													vendorID = :purchsVendorID 
												WHERE purchaseID = :purchID';
					$purchStatement = $dbcon->prepare($editPur);
					$purchStatement->execute(['itemNumber' => $purchItemNumber, 
					                          'purchaseDate' => $purchDate, 
											  'itemName' => $purchItemName, 
											  'unitPrice' => $purchUnitPrice, 
											  'quantity' => $purchQuantity, 
											  'vendorName' => $purchVendorName, 
											  'vendorID' => $purchVendorID, 
											  'purchaseID' => $purchID]);
					
					echo '<div class="alert alert-success">
					            <button type="button" class="close" data-dismiss="alert">&times;</button>Purchase details added to database and stock values updated.
						  </div>';
					exit();
					
				} else {
					
					/* Get the quantity (stock) in item table */
					
					$qItem = 'SELECT * FROM item WHERE itemNumber=:purchItemNumber';
					$itemStatement = $dbcon->prepare($qItem);
					$itemStatement->execute(['itemNumber' => $purchItemNumber]);
					
					if($itemStatement->rowCount() > 0){
						/* Item exists in the item table, therefore, start inserting data to purchase table */
						
					/* 	Calculate the new stock value using the existing stock in item table */
						
						$resultItem = $itemStatement->fetch(PDO::FETCH_ASSOC);
						$orderQuantity = $purchQuantity;
						$balanceStock = $resultItem['stock'];
						$newStock = $balanceStock + ($orderQuantity - $previousOrderQuantity);
						
						/*  Edit the new stock value in item table. */
						
						$editItem = 'UPDATE item SET stock = :stock WHERE itemNumber = :purchItemNumber';
						$itemStatement = $dbcon->prepare($editItem);
						$itemStatement->execute(['stock' => $newStock, 'itemNumber' => $purchItemNumber]);
						
						/* update the purchase table */
						
						$editPur = 'UPDATE purchase SET purchaseDate = :purchaseDate, 
						                                unitPrice = :purchUnitPrice, 
														quantity = :purchQuantity, 
														vendorName = :purchVendorName, 
														vendorID = :purchVendorID 
													WHERE purchaseID = :purcID';
						$purchStatement = $dbcon->prepare($editPur);
						$purchStatement->execute(['purchaseDate' => $purchDate, 
						                          'unitPrice' => $purchUnitPrice, 
												  'quantity' => $purchQuantity, 
												  'vendorName' => $purchVendorName, 
												  'vendorID' => $purchvendorID, 
												  'purchaseID' => $purchID]);
						
						echo '<div class="alert alert-success">
						           <button type="button" class="close" data-dismiss="alert">&times;</button>Purchase details added to database and stock values updated.
							  </div>';
						exit();
						
					} else {
						/* Item does not exist in item table, therefore, you can't update */ 
						/*  purchase details for it */ 
						echo '<div class="alert alert-danger">
						          <button type="button" class="close" data-dismiss="alert">&times;</button>Item does not exist in DB. Therefore, first enter this item to DB using the <strong>Item</strong> tab.
							 </div>';
						exit();
					}	
					
				}
	
			} else {
				
				/*  PurchaseID does not exist in purchase table,you can't update it */ 
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>Purchase details does not exist in DB for the given Purchase ID. Therefore, can\'t update.
					  </div>';
				exit();
				
			}

		} else {
			// One or more mandatory fields are empty. Therefore, display the error message
			echo '<div class="alert alert-danger">
			          <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter all fields marked with a (*)
				  </div>';
			exit();
		}
	}
?>
