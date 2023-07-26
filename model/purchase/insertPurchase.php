<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');
	
	if(isset($_POST['purchaseItemNumber'])){

		$purchaseItemNumber = htmlentities($_POST['purItemNumber']);
		$purchaseDate = htmlentities($_POST['purDate']);
		$purchaseItemName = htmlentities($_POST['purItemName']);
		$purchaseQuantity = htmlentities($_POST['purQuantity']);
		$purchaseUnitPrice = htmlentities($_POST['purUnitPrice']);
		$purchaseVendorName = htmlentities($_POST['purVendorName']);
		
		$initStock = 0;
		$newStock = 0;
		
		// Check if mandatory fields are not empty
		if(isset($purchaseItemNumber) && isset($purchaseDate) && isset($purchaseItemName) && isset($purchaseQuantity) && isset($purchaseUnitPrice)){
			
			// Check if itemNumber is empty
			if($purchaseItemNumber == ''){ 
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter Item Number.</div>';
				exit();
			}
			
			// Check if itemName is empty
			if($purchaseItemName == ''){ 
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter Item Name.</div>';
				exit();
			}
			
			// Check if quantity is empty
			if($purchaseQuantity == ''){ 
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter Quantity.</div>';
				exit();
			}
			
			// Check if unit price is empty
			if($purchaseUnitPrice == ''){ 
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter Unit Price.</div>';
				exit();
			}
			
			// Sanitize item number
			$purchaseItemNumber = filter_var($purchaseItemNumber, FILTER_SANITIZE_STRING);
			
			// Validate item quantity. It has to be an integer
			if(filter_var($purchaseQuantity, FILTER_VALIDATE_INT) === 0 || filter_var($purchaseQuantity, FILTER_VALIDATE_INT)){
				// Valid quantity
			} else {
				// Quantity is not a valid number
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for quantity.</div>';
				exit();
			}
			
			// Validate unit price. It has to be an integer or floating point value
			if(filter_var($purchaseUnitPrice, FILTER_VALIDATE_FLOAT) === 0.0 || filter_var($purchaseUnitPrice, FILTER_VALIDATE_FLOAT)){
				// Valid unit price
			} else {
				// Unit price is not a valid number
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for unit price.</div>';
				exit();
			}
			
			// Check if the item exists in item table and 
			// calculate the stock values and update to match the new purchase quantity
			$queryStock = 'SELECT stock FROM item WHERE itemNumber=:itemNumber';
			$stockStatement = $conn->prepare($queryStock);
			$stockStatement->execute(['itemNumber' => $purchaseItemNumber]);
			if($stockStatement->rowCount() > 0){
				
				// Get the vendorId for the given vendorName
				
				$QueryVendor = 'SELECT * FROM vendor WHERE fullName = :fullName';
				$vendorStatement = $conn->prepare($queryVendor);
				$vendorStatement->execute(['fullName' => $purchaseVendorName]);
				$row = $vendorStatement->fetch(PDO::FETCH_ASSOC);
				$vendorID = $row['vendorID'];
				
				// Item exits in the item table, therefore, start the inserting data to purchase table
				$insertPurchase = 'INSERT INTO purchase(itemNumber, purchaseDate, itemName, unitPrice, quantity, vendorName, vendorID) VALUES(:itemNumber, :purchaseDate, :itemName, :unitPrice, :quantity, :vendorName, :vendorID)';
				$insertPurchaseStatement = $conn->prepare($insertPurchase);
				$insertPurchaseStatement->execute(['itemNumber' => $purchaseItemNumber, 'purchaseDate' => $purchaseDate, 'itemName' => $purchaseItemName, 'unitPrice' => $purchaseUnitPrice, 'quantity' => $purchaseQuantity, 'vendorName' => $purchaseVendorName, 'vendorID' => $vendorID]);
				
				// Calculate the new stock value using the existing stock in item table
				$row = $stockStatement->fetch(PDO::FETCH_ASSOC);
				$initStock = $row['stock'];
				$newStock = $initStock + $purchaseQuantity;
				
				// Edit the new stock value in item table
				$editStock = 'UPDATE item SET stock = :stock WHERE itemNumber = :itemNumber';
				$updateStockItemStatement = $conn->prepare($updateStockSql);
				$updateStockItemStatement->execute(['stock' => $newStock, 'itemNumber' => $purchaseItemNumber]);
				
				echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Purchase details added to database and stock values updated.</div>';
				exit();
				
			} else {
				// Item does not exist in item table, therefore, you can't make a purchase from it 
				// to add it to DB as a new purchase
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Item does not exist in DB. Therefore, first enter this item to DB using the <strong>Item</strong> tab.</div>';
				exit();
			}

		} else {
			// One or more mandatory fields are empty. Therefore, display a the error message
			echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter all fields marked with a (*)</div>';
			exit();
		}
	}
?>
