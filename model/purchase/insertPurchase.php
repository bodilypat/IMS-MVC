<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');
	
	if(isset($_POST['purchaseItemNumber'])){
		$purchaseItemNumber = htmlentities($_POST['purchaseItemNumber']);
		$purchaseDate = htmlentities($_POST['purchaseDate']);
		$purchaseItemName = htmlentities($_POST['purchaseItemName']);
		$purchaseQuantity = htmlentities($_POST['purchaseQuantity']);
		$purchaseUnitPrice = htmlentities($_POST['purchaseUnitPrice']);
		$purchaseVendorName = htmlentities($_POST['purchaseVendorName']);
		
		$initStock = 0;
		$newStock = 0;
		
		/* Check if mandatory fields are not empty */
		if(isset($purchaseItemNumber) && isset($purchaseDate) && isset($purchaseItemName) && isset($purchaseQuantity) && isset($purchaseUnitPrice)){
			
			if($purchaseItemNumber == ''){ 
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter Item Number.</div>';
				exit();
			}
						
			if($purchaseItemName == ''){ 
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter Item Name.</div>';
				exit();
			}
			
			if($purchaseQuantity == ''){ 
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter Quantity.</div>';
				exit();
			}
			
			
			if($purchaseUnitPrice == ''){ 
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter Unit Price.</div>';
				exit();
			}
			
			$purchaseItemNumber = filter_var($purchaseItemNumber, FILTER_SANITIZE_STRING);
			
			if(filter_var($purchaseQuantity, FILTER_VALIDATE_INT) === 0 || filter_var($purchaseQuantity, FILTER_VALIDATE_INT)){
			} else {
				/* Quantity is not a valid number */
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for quantity.</div>';
				exit();
			}
			
			/* Validate unit price. It has to be an integer or floating point value */
		    if(filter_var($purchaseUnitPrice, FILTER_VALIDATE_FLOAT) === 0.0 || filter_var($purchaseUnitPrice, FILTER_VALIDATE_FLOAT)){
				
			} else {
				
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for unit price.</div>';
				exit();
			}
						 
			/* calculate the stock values and update to match the new purchase quantity */
			$qStock= 'SELECT stock FROM item WHERE itemNumber=:itemNumber';
			$itemStatement = $conn->prepare($qStock);
			$itemStatement->execute(['itemNumber' => $purchaseItemNumber]);

			if($stockStatement->rowCount() > 0){
				
				/* Get vendorId for the given vendorName */
				
				$qVendor = 'SELECT * FROM vendor WHERE fullName = :fullName';
				$vendorStatement = $conn->prepare($qVendor);
				$vendorStatement->execute(['fullName' => $purchaseVendorName]);

				$resultVen = $vendorStatement->fetch(PDO::FETCH_ASSOC);
				$vendorID = $resultVen['vendorID'];
				
				/*  Item exits in the item table, inserting data to purchase table */
				$addPurchase = 'INSERT INTO purchase(itemNumber, purchaseDate, itemName, unitPrice, quantity, vendorName, vendorID) VALUES(:itemNumber, :purchaseDate, :itemName, :unitPrice, :quantity, :vendorName, :vendorID)';
				$insertPurchaseStatement = $conn->prepare($addPurchase);
				$insertPurchaseStatement->execute(['itemNumber' => $purchaseItemNumber, 'purchaseDate' => $purchaseDate, 'itemName' => $purchaseItemName, 'unitPrice' => $purchaseUnitPrice, 'quantity' => $purchaseQuantity, 'vendorName' => $purchaseVendorName, 'vendorID' => $vendorID]);
				
				/*  Calculate the new stock value using the existing stock in item table */
				$resultItem = $stockStatement->fetch(PDO::FETCH_ASSOC);
				$initStock = $resultItem['stock'];
				$newStock = $initStock + $purchaseQuantity;
				
				/* Edit the new stock value in item table */
				$editStock = 'UPDATE item SET stock = :stock WHERE itemNumber = :itemNumber';
				$updateStockItemStatement = $conn->prepare($editStock);
				$updateStockItemStatement->execute(['stock' => $newStock, 'itemNumber' => $purchaseItemNumber]);
				
				echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Purchase details added to database and stock values updated.</div>';
				exit();
				
			} else {
				/* Item does not exist in item table */ 
				/*  to add it to DB as a new purchase */
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Item does not exist in DB. Therefore, first enter this item to DB using the <strong>Item</strong> tab.</div>';
				exit();
			}

		} else {
			/* One or more mandatory fields are empty. display a the error message */
			echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter all fields marked with a (*)</div>';
			exit();
		}
	}
?>
