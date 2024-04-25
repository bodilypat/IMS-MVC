<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/dbconnect.php');
	
	if(isset($_POST['purchaseID'])){

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
		
		/* check mandatory fields not empty */
		if(isset($purchaseItemNumber) && isset($purchaseDate) && isset($purchaseQuantity) && isset($purchaseUnitPrice)){
			
			/* Sanitize itemNumber */
			$purchaseItemNumber = filter_var($purchaseItemNumber, FILTER_SANITIZE_STRING);
			
			/* validate Quantity */
			if(filter_var($purchaseQuantity, FILTER_VALIDATE_INT) === 0 || filter_var($purchaseQuantity, FILTER_VALIDATE_INT)){
				/* quantity valid */
			} else {

				/* quanatity invalid */
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>
						   Please enter a valid number for quantity.
					  </div>';
				exit();
			}
			
			/* validate unitPrice  */
			if(filter_var($purchaseUnitPrice, FILTER_VALIDATE_FLOAT) === 0.0 || filter_var($purchaseUnitPrice, FILTER_VALIDATE_FLOAT)){
				/* UnitPrice valid */
			} else {
				/* unitPrice is invalid */
				echo '<div class="alert alert-danger">
				          <button type="button" class="close" data-dismiss="alert">&times;</button>
						  Please enter a valid number for unit price.
					  </div>';
				exit();
			}
			
			/* check purchaseID  */
			if($purchaseID == ''){ 
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>
						   Please enter a Purchase ID.
					  </div>';
				exit();
			}
			
			/* check itemNumber is empty */
			if($purchaseItemNumber == ''){ 
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>
						   Please enter Item Number.
					 </div>';
				exit();
			}
			/* check quantity */
			if($purchaseQuantity == ''){ 
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter quantity.
					 </div>';
				exit();
			}
			
			/* query purchase object in DB */
			$qPurch = "SELECT * FROM purchase WHERE purchaseID = '$purchaseID'";
			$purchStatement = $dbcon>prepare($qPurch);
			$purchStatement->execute(['purchaseID' => $purchaseID]);
			
			/* query vendor object in DB */
			$qVen = " SELECT * FROM vendor WHERE fullName = '$fullName'";
			$venStatement = $dbcon->prepare($qVen);
			$venStatement->execute(['fullName' => $purchaseVendorName]);
			/* get vendorID from vendor object */
			$resultVen = $venStatement->fetch(PDO::FETCH_ASSOC);
			$vendorID = $resultven['vendorID'];
			
			if($purchStatement->rowCount() > 0){
				/* qet quantity , itemnumber from purchase object */
				$resultPur = $purchStatement->fetch(PDO::FETCH_ASSOC);
				$orderQuantity = $resultPur['quantity'];
				$orderItemNumber = $resultPur['itemNumber'];

				if($orderItemNumber !== $purchaseItemNumber) {
					/* query item object in DB */
					$qItem = "SELECT * FROM item WHERE itemNumber = '$itemNumber'";
					$itemStatement = $dbcon->prepare($qItem);
					$itemStatement->execute(['itemNumber' => $purchaseItemNumber]);
					
					if($itemStatement->rowCount() < 1){
						/* itemNumber is not exist in DB */
						echo '<div class="alert alert-danger">
						          <button type="button" class="close" data-dismiss="alert">&times;</button>
								  Item Number does not exist in DB. If you want to update this item, please add it to DB first.
							 </div>';
						exit();
					}
					
					/* found it  calculate newStock */
					$resultItem = $itemStatement->fetch(PDO::FETCH_ASSOC);
					$balanceStock = $resultItem['stock'];
					$newOrderQuantity = $purchaseQuantity;
					$newStock = $balanceStock + $newOrderQuantity;
					
					/* update item */
					$editItem = "UPDATE item SET stock = '$newstock' WHERE itemNumber = '$itemNumber'";
					$updateItemStatement = $dbcon->prepare($editItem);
					$updateItemStatement->execute(['stock' => $newStock, 'itemNumber' => $purchaseItemNumber]);
				
					/* get current stock  */	
					$qItem = " SELECT * FROM item WHERE itemNumber='$itemNumber'";
					$itemStatement = $dbcon->prepare($qItem);
					$itemStatement->execute(['itemNumber' => $orderItemNumber]);
					
					/* calculate new stock  */
					$resultItem = $itemStatement->fetch(PDO::FETCH_ASSOC);
					$balanceStock = $resultItem['stock'];
					$newStock = $balanceStock - $orderQuantity;
					
					/* edit stock current stock */
					
					$editItem = "UPDATE item SET stock = '$newStock' WHERE itemNumber = '$itemNumber'";
					$updateItemStatement = $dbcon->prepare($editItem);
					$updateItemStatement->execute(['stock' => $newStock, 'itemNumber' => $orderItemNumber]);
					
					/* update purchase for new item */
					$editPurch = " UPDATE purchase SET itemNumber = '$itemNumber', 
					                                  purchaseDate = '$purchaseDate', 
													  itemName = '$purchaseitemName', 
													  unitPrice = '$purchseUnitPrice', 
													  quantity = '$purchaseQuantity', 
													  vendorName = '$purchaseVendorName', 
													  vendorID = '$purchaseVendorID' 
												WHERE purchaseID = '$purchaseID'";
					$updatePurchStatement = $conn->prepare($updatePurchase);
					$updatePurchStatement->execute(['itemNumber' => $purchaseItemNumber,
					                                'purchaseDate' => $purchaseDate, 
													'itemName' => $purchaseItemName, 
													'unitPrice' => $purchaseUnitPrice, 
													'quantity' => $purchaseQuantity, 
													'vendorName' => $purchaseVendorName, 
													'vendorID' => $vendorID, 
													'purchaseID' => $purchaseID]);
					
					echo '<div class="alert alert-success">
					           <button type="button" class="close" data-dismiss="alert">&times;</button>
							   Purchase details added to database and stock values updated.
						  </div>';
					exit();
					
				} else {
					/* itemNumber is equal, itemNumber is valid */
					/* get quantity from object table in DB */
					$qItem = "SELECT * FROM item WHERE itemNumber='$purchaseItemNumber'";
					$itemStatement = $dbcon->prepare($qItem);
					$itemStatement->execute(['itemNumber' => $purchaseItemNumber]);
					
					if($stockStatement->rowCount() > 0){
						/* itemNumber exists in database */
						/* calculate new stock */
						
						$resultItem = $itemStatement->fetch(PDO::FETCH_ASSOC);
						$newOrderQuantity = $purchaseQuantity;
						$balanceStock = $resultItem['stock'];
						$newStock = $balanceStock + ($newOrderQuantity - $orderQuantity);
						/* update newStock */
						$editItem = " UPDATE item SET stock = '$newStock' WHERE itemNumber = '$itemNumber'";
						$updateItemStatement = $dbcon->prepare($editStock);
						$updateItemStatement->execute(['stock' => $newStock, 'itemNumber' => $purchaseItemNumber]);
						
						/* update purchase  */
						$editPurch = " UPDATE purchase SET purchaseDate = '$purchaseDate', 
														  unitPrice = '$purchUnitPrice', 
														  quantity = '$purcQquantity', 
														  vendorName = '$purchVendorName', 
													      vendorID = '$vendorID'
						                              WHERE purchaseID = '$purchaseID'";
						$updatePurchStatement = $dbcon->prepare($editPurch);
						$updatePurchStatement->execute(['purchaseDate' => $purchaseDate, 
						                                'unitPrice' => $purchaseUnitPrice, 
														'quantity' => $purchaseQuantity, 
														'vendorName' => $purchaseVendorName, 
														'vendorID' => $vendorID, 
														'purchaseID' => $purchaseID]);
						
						echo '<div class="alert alert-success">
						           <button type="button" class="close" data-dismiss="alert">&times;</button>
								   Purchase details added to database and stock values updated.
							  </div>';
						exit();
						
					} else {
						/* itemNumber does not exist  */
						echo '<div class="alert alert-danger">
						          <button type="button" class="close" data-dismiss="alert">&times;</button>
								  Item does not exist in DB. Therefore, first enter this item to DB using the 
								  <strong>Item</strong> tab.
							  </div>';
						exit();
					}	
					
				}
	
			} else {
				/* purchseID does not exist */
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>
						   Purchase details does not exist in DB for the given Purchase ID. Therefore, can\'t update.
					  </div>';
				exit();
				
			}

		} else {
			/* mandatory field are empty */
			echo '<div class="alert alert-danger">
			          <button type="button" class="close" data-dismiss="alert">&times;</button>
					  Please enter all fields marked with a (*)
				  </div>';
			exit();
		}
	}
?>