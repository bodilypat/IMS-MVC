<?php

	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');
	
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
		
		/*  Check if mandatory fields are not empty */
		if(isset($purchaseItemNumber) && isset($purchaseDate) && isset($purchaseQuantity) && isset($purchaseUnitPrice)){
			
			/* Sanitize item number */
			$purchaseItemNumber = filter_var($purchaseItemNumber, FILTER_SANITIZE_STRING);
			
			/*  Validate item quantity. It has to be an integer */
			if(filter_var($purchaseQuantity, FILTER_VALIDATE_INT) === 0 || filter_var($purchaseQuantity, FILTER_VALIDATE_INT)){				
			} else {				
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for quantity.</div>';
				exit();
			}

			if(filter_var($purchaseUnitPrice, FILTER_VALIDATE_FLOAT) === 0.0 || filter_var($purchaseUnitPrice, FILTER_VALIDATE_FLOAT)){
			} else {	
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for unit price.</div>';
				exit();
			}
			
			if($purchaseID == ''){ 
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a Purchase ID.</div>';
				exit();
			}
			
			if($purchaseItemNumber == ''){ 
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter Item Number.</div>';
				exit();
			}
			
			if($purchaseQuantity == ''){ 
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter quantity.</div>';
				exit();
			}
			
			$qPurchase = 'SELECT * FROM purchase WHERE purchaseID = :purchaseID';
			$purchaseStatement = $conn->prepare($qPurchase);
			$purchaseStatement->execute(['purchaseID' => $purchaseID]);
			
			/* Get the vendorId for the given vendorName */
			
			$qVendor = 'SELECT * FROM vendor WHERE fullName = :fullName';
			$vendorStatement = $conn->prepare($qVendor);
			$vendorStatement->execute(['fullName' => $purchaseVendorName]);

			$row = $vendorStatement->fetch(PDO::FETCH_ASSOC);
			$vendorID = $row['vendorID'];
			
			if($purchaseStatement->rowCount() > 0){
				
				/* Purchase details exist in DB. Hence proceed to calculate the stock */
				$resultPurch = $purchaseStatement->fetch(PDO::FETCH_ASSOC);
				$quantityOrder = $resultPurch['quantity'];
				$orderItemNumber = $resultPurch['itemNumber'];

				/* 	Check if the original itemNumber is the same as the new itemNumber */
				if($orderItemNumber !== $purchaseItemNumber) {

					$qItem = 'SELECT * FROM item WHERE itemNumber = :itemNumber';
					$itemStatement = $conn->prepare($qItem);
					$itemStatement->execute(['itemNumber' => $purchaseItemNumber]);
					
					if($itemStatement->rowCount() < 1){
						
						echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Item Number does not exist in DB. If you want to update this item, please add it to DB first.</div>';
						exit();
					}
					
					/* Calculate the new stock value for new item using the existing stock in item table */	
					$resultItem = $itemStatement->fetch(PDO::FETCH_ASSOC);
					$quantityStockItem = $resultItem['stock'];
					$quantityOrder = $purchaseQuantity;
					$newStockItem = $quantityStockItem + $quantityOrder;
					
					/*  Edit the stock for new item in item table */
					
					$editStock = 'UPDATE item SET stock = :stock WHERE itemNumber = :itemNumber';
					$updateStockItemStatement = $conn->prepare($editStock);
					$updateStockItemStatement->execute(['stock' => $newStockItem, 'itemNumber' => $purchaseItemNumber]);
					
					/* Get the current stock of the previous item */
					
					$qItem = 'SELECT * FROM item WHERE itemNumber=:itemNumber';
					$itemStatement = $conn->prepare($qItem);
					$itemStatement->execute(['itemNumber' => $OrderItemNumber]);
					
					/* Calculate the new stock value for the previous item using the existing stock in item table */
					
					$itemInfo = $itemStatement->fetch(PDO::FETCH_ASSOC);
					$currentStockItem = $itemInfo['stock'];
					$newStockItem = $currentStockItem - $quantityOrder;
					
					/* EDIT the stock for previous item in item table */
					
					$editStock = 'UPDATE item SET stock = :stock WHERE itemNumber = :itemNumber';
					$updateStockItemStatement = $conn->prepare($editStock);
					$updateStockItemStatement->execute(['stock' => $newStockItem, 'itemNumber' => $OrderItemNumber]);
					
					/*  Finally UPDATE the purchase table for new item */
					
					$updatePurchase = 'UPDATE purchase SET itemNumber = :itemNumber, purchaseDate = :purchaseDate, itemName = :itemName, unitPrice = :unitPrice, quantity = :quantity, vendorName = :vendorName, vendorID = :vendorID WHERE purchaseID = :purchaseID';
					$updatePurchaseStatement = $conn->prepare($updatePurchase);
					$updatePurchaseStatement->execute(['itemNumber' => $purchaseItemNumber, 'purchaseDate' => $purchaseDate, 'itemName' => $purchaseItemName, 'unitPrice' => $purchaseUnitPrice, 'quantity' => $purchaseQuantity, 'vendorName' => $purchaseVendorName, 'vendorID' => $vendorID, 'purchaseID' => $purchaseID]);
					
					echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Purchase details added to database and stock values updated.</div>';
					exit();
					
				} else {
					
					/* Get the quantity (stock) in item table */
					
					$qItem = 'SELECT * FROM item WHERE itemNumber=:itemNumber';
					$itemStatement = $conn->prepare($qItem);
					$itemStatement->execute(['itemNumber' => $purchaseItemNumber]);
					
					if($itemStatement->rowCount() > 0){
						/* Item exists in the item table, therefore, start inserting data to purchase table */
						
					/* 	Calculate the new stock value using the existing stock in item table */
						
						$row = $itemStatement->fetch(PDO::FETCH_ASSOC);
						$quantityNewOrder = $purchaseQuantity;
						$stockItem = $row['stock'];
						$newStock = $stockItem + ($quantityNewOrder - $quantityOrder);
						
						/*  Edit the new stock value in item table. */
						
						$editStock = 'UPDATE item SET stock = :stock WHERE itemNumber = :itemNumber';
						$updatStockItemStatement = $conn->prepare($editStock);
						$updateStockItemStatement->execute(['stock' => $newStock, 'itemNumber' => $purchaseItemNumber]);
						
						/* update the purchase table */
						
						$updatePurchase = 'UPDATE purchase SET purchaseDate = :purchaseDate, unitPrice = :unitPrice, quantity = :quantity, vendorName = :vendorName, vendorID = :vendorID WHERE purchaseID = :purchaseID';
						$updatePurchaseStatement = $conn->prepare($updatePurchase);
						$updatePurchaseStatement->execute(['purchaseDate' => $purchaseDate, 'unitPrice' => $purchaseUnitPrice, 'quantity' => $purchaseQuantity, 'vendorName' => $purchaseVendorName, 'vendorID' => $vendorID, 'purchaseID' => $purchaseID]);
						
						echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Purchase details added to database and stock values updated.</div>';
						exit();
						
					} else {
						/* Item does not exist in item table, therefore, you can't update */ 
						/*  purchase details for it */ 
						echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Item does not exist in DB. Therefore, first enter this item to DB using the <strong>Item</strong> tab.</div>';
						exit();
					}	
					
				}
	
			} else {
				
				/*  PurchaseID does not exist in purchase table,you can't update it */ 
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
