<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/db.php');
	
	// Check if the POST query is received
	if(isset($_POST['itemNumber'])) {
		
		$itemNumber = htmlentities($_POST['itemNumber']);
		$itemName = htmlentities($_POST['itemName']);
		$itemDiscount = htmlentities($_POST['itemDiscount']);
		$itemQuantity = htmlentities($_POST['itemQuantity']);
		$itemUnitPrice = htmlentities($_POST['itemUnitPrice']);
		$itemStatus = htmlentities($_POST['itemStatus']);
		$itemDescription = htmlentities($_POST['itemDescription']);
		
		$balanceStock = 0;
		$newStock = 0;
		
		// Check if mandatory fields are not empty
		if(!empty($itemNumber) && !empty($itemName) && isset($itemQuantity) && isset($itemUnitPrice)){
			
			// Sanitize item number
			$itemNumber = filter_var($itemNumber, FILTER_SANITIZE_STRING);
			
			// Validate item quantity. It has to be a number
			if(filter_var($itemQuantity, FILTER_VALIDATE_INT) === 0 || filter_var($itemQuantity, FILTER_VALIDATE_INT)){
				// Valid quantity
			} else {
				// Quantity is not a valid number
				$errorAlert = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for quantity</div>';
				$data = ['alertMessage' => $errorAlert];
				echo json_encode($data);
				exit();
			}
			
			// Validate unit price. It has to be a number or floating point value
			if(filter_var($itemUnitPrice, FILTER_VALIDATE_FLOAT) === 0.0 || filter_var($itemUnitPrice, FILTER_VALIDATE_FLOAT)){
				// Valid unit price
			} else {
				// Unit price is not a valid number
				$errorAlert = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for unit price</div>';
				$data = ['alertMessage' => $errorAlert];
				echo json_encode($data);
				exit();
			}
			
			// Validate discount only if it's provided
			if(!empty($itemDiscount)){
				if(filter_var($itemDiscount, FILTER_VALIDATE_FLOAT) === false){
					// Discount is not a valid floating point number
					$errorAlert = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid discount amount</div>';
					$data = ['alertMessage' => $errorAlert];
					echo json_encode($data);
					exit();
				}
			}
			
			// Calculate the stock
			$qItem = 'SELECT stock FROM item WHERE itemNumber = :itemNumber';
			$itemStatement = $conn->prepare($qItem);
			$itemStatement->execute(['itemNumber' => $itemNumber]);
			if($itemStatement->rowCount() > 0) {
				$result = $itemStatement->fetch(PDO::FETCH_ASSOC);
				$balanceStock = $result['stock'];
				$newStock = $balanceStock + $itemQuantity;
			} else {
				// Item is not in DB. Therefore, stop the update and quit
				$errorAlert = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Item Number does not exist in DB. Therefore, update not possible.</div>';
				$data = ['alertMessage' => $errorAlert];
				echo json_encode($data);
				exit();
			}
		
			// Construct the UPDATE query
			$editItem = 'UPDATE item SET itemName = :itemName, discount = :itemDiscount, stock = :NewStock, unitPrice = :itemUnitPrice, status = :itemStatus, description = :itemDescription WHERE itemNumber = :itemNumber';
			$updateItemStatement = $dbcon->prepare($editItem);
			$updateItemStatement->execute(['itemName' => $itemName, 'discount' => $itemDiscount, 'stock' => $newStock, 'unitPrice' => $itemUnitPrice, 'status' => $itemStatus, 'description' => $itemDescription, 'itemNumber' => $itemNumber]);
			
			// EDIT	item name in sale table
			$editSale = 'UPDATE sale SET itemName = :itemName WHERE itemNumber = :itemNumber';
			$updateSaleStatement = $dbcon->prepare($editSale);
			$updateSaleStatement->execute(['itemName' => $itemName, 'itemNumber' => $itemNumber]);
			
			// UPDATE item name in purchase table
			$editPurch = 'UPDATE purchase SET itemName = :itemName WHERE itemNumber = :itemNumber';
			$updatePurchStatement = $dbcon->prepare($editPurch);
			$updatePurchStatement->execute(['itemName' => $itemName, 'itemNumber' => $itemNumber]);
			
			$successAlert = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Item details updated.</div>';
			$data = ['alertMessage' => $successAlert, 'newStock' => $newStock];
			echo json_encode($data);
			exit();
			
		} else {
			// One or more mandatory fields are empty. Therefore, display the error message
			$errorAlert = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter all fields marked with a (*)</div>';
			$data = ['alertMessage' => $errorAlert];
			echo json_encode($data);
			exit();
		}
	}
?>