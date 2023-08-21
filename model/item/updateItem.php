<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');
	
	// Check POST query is received
	if(isset($_POST['itemNumber'])) {
		
		$itemNumber = htmlentities($_POST['itemNumber']);
		$itemName = htmlentities($_POST['itemName']);
		$discount = htmlentities($_POST['itemDiscount']);
		$quantity = htmlentities($_POST['itemQuantity']);
		$unitPrice = htmlentities($_POST['itemUnitPrice']);
		$status = htmlentities($_POST['itemStatus']);
		$description = htmlentities($_POST['itemDescription']);
		
		$initStock = 0;
		$newStock = 0;
		
		/*  Check if mandatory fields are not empty */
		if(!empty($itemNumber) && !empty($itemName) && isset($quantity) && isset($unitPrice)){
			
			/* Sanitize item number */
			$itemNumber = filter_var($itemNumber, FILTER_SANITIZE_STRING);
			
			/* Validate item quantity. It has to be a number */
			if(filter_var($quantity, FILTER_VALIDATE_INT) === 0 || filter_var($Quantity, FILTER_VALIDATE_INT)){			
			} else {
				/*  Quantity is not a valid number */
				$errorAlert = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for quantity</div>';
				$data = ['alertMessage' => $errorAlert];
				echo json_encode($data);
				exit();
			}
			
		/* 	// Validate unit price.  */
			if(filter_var($unitPrice, FILTER_VALIDATE_FLOAT) === 0.0 || filter_var($unitPrice, FILTER_VALIDATE_FLOAT)){				
			} else {
				$errorAlert = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for unit price</div>';
				$data = ['alertMessage' => $errorAlert];
				echo json_encode($data);
				exit();
			}
			
			/*  Validate discount ,if it's provided */
			if(!empty($discount)){
				if(filter_var($discount, FILTER_VALIDATE_FLOAT) === false){
					$errorAlert = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid discount amount</div>';
					$data = ['alertMessage' => $errorAlert];
					echo json_encode($data);
					exit();
				}
			}
			
			/* Calculate the stock */
			$qStock = 'SELECT stock FROM item WHERE itemNumber = :itemNumber';
			$itemStatement = $conn->prepare($qStock);
			$itemStatement->execute(['itemNumber' => $itemNumber]);
			if($itemStatement->rowCount() > 0) {
				$row = $itemStatement->fetch(PDO::FETCH_ASSOC);
				$initStock = $row['stock'];
				$newStock = $initStock + $quantity;
			} else {
				/*  Item is not in DB. stop the update and quit */
				$errorAlert = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Item Number does not exist in DB. Therefore, update not possible.</div>';
				$data = ['alertMessage' => $errorAlert];
				echo json_encode($data);
				exit();
			}
		
			/*  Construct the UPDATE Item table */
			$updateItem = 'UPDATE item SET itemName = :itemName, discount = :discount, stock = :stock, unitPrice = :unitPrice, status = :status, description = :description WHERE itemNumber = :itemNumber';
			$updateItemStatement = $conn->prepare($updateItem);
			$updateItemStatement->execute(['itemName' => $itemName, 'discount' => $discount, 'stock' => $newStock, 'unitPrice' => $unitPrice, 'status' => $status, 'description' => $description, 'itemNumber' => $itemNumber]);
			
			/*  EDIT	item name in sale table */
			$editSale = 'UPDATE sale SET itemName = :itemName WHERE itemNumber = :itemNumber';
			$updateSaleStatement = $conn->prepare($editIname);
			$updateSaleStatement->execute(['itemName' => $itemName, 'itemNumber' => $itemNumber]);
			
			/* UPDATE item name in purchase table */
			$editIname = 'UPDATE purchase SET itemName = :itemName WHERE itemNumber = :itemNumber';
			$updatePurchaseStatement = $conn->prepare($editIname);
			$updatePurchaseStatement->execute(['itemName' => $itemName, 'itemNumber' => $itemNumber]);
			
			$successAlert = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Item details updated.</div>';
			$data = ['alertMessage' => $successAlert, 'newStock' => $newStock];
			echo json_encode($data);
			exit();
			
		} else {
			/* One or more mandatory fields are empty.display the error message */
			$errorAlert = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter all fields marked with a (*)</div>';
			$data = ['alertMessage' => $errorAlert];
			echo json_encode($data);
			exit();
		}
	}
?>