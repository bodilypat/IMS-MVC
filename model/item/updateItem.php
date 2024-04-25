<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/dbconnect.php');
	
	/* check received */
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
		
		/* check madatory field not empty */
		if(!empty($itemNumber) && !empty($itemName) && isset($itemQuantity) && isset($itemUnitPrice)){
			
			/* Sanitize itemNumber */
			$itemNumber = filter_var($itemNumber, FILTER_SANITIZE_STRING);
			
			/* Validate itemQuantity */
			if(filter_var($itemQuantity, FILTER_VALIDATE_INT) === 0 || filter_var($itemQuantity, FILTER_VALIDATE_INT)){
				/* valid quantity */
			} else {
				/* invalid quantity */
				$errorAlert = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for quantity</div>';
				$data = ['alertMessage' => $errorAlert];
				echo json_encode($data);
				exit();
			}
			
			/* validate unitPrice */
			if(filter_var($itemUnitPrice, FILTER_VALIDATE_FLOAT) === 0.0 || filter_var($itemUnitPrice, FILTER_VALIDATE_FLOAT)){
				/* valid unitPrice */
			} else {
				/* invalid unitPrice */
				$errorAlert = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for unit price</div>';
				$data = ['alertMessage' => $errorAlert];
				echo json_encode($data);
				exit();
			}
			
			/* validate discount */
			if(!empty($itemDiscount)){
				if(filter_var($itemDiscount, FILTER_VALIDATE_FLOAT) === false){
					/* invalid discount */
					$errorAlert = '<div class="alert alert-danger">
					                    <button type="button" class="close" data-dismiss="alert">&times;</button>
										Please enter a valid discount amount
								   </div>';
					$data = ['alertMessage' => $errorAlert];
					echo json_encode($data);
					exit();
				}
			}
			
			/* get item object by itemNumber */
			$qItem = 'SELECT stock FROM item WHERE itemNumber = :itemNumber';
			$itemStatement = $conn->prepare($qItem);
			$itemStatement->execute(['itemNumber' => $itemNumber]);
			/* get stock from item object */
			if($itemStatement->rowCount() > 0) {
				$resultItem = $itemStatement->fetch(PDO::FETCH_ASSOC);
				$balanceStock = $resultItem['stock'];
				$newStock = $balanceStock + $itemQuantity;
			} else {
				/* itemNumber is not in DB , stop and quit */
				$errorAlert = '<div class="alert alert-danger">
				                   <button type="button" class="close" data-dismiss="alert">&times;</button>
								   Item Number does not exist in DB. Therefore, update not possible.
							  </div>';
				$data = ['alertMessage' => $errorAlert];
				echo json_encode($data);
				exit();
			}
			/* exist in database */
			$editItem = " UPDATE item SET itemName = '$itemName', 
										  discount = '$itemDiscount', 
										  stock = '$NewStock', 
										  unitPrice = '$itemUnitPrice', 
										  status = '$itemStatus', 
										  description = '$itemDescription' 
								   WHERE itemNumber = '$itemNumber'";
			$updateItemStatement = $dbcon->prepare($editItem);
			$updateItemStatement->execute(['itemName' => $itemName, 
			                                'discount' => $itemDiscount, 
											'stock' => $newStock, 
											'unitPrice' => $itemUnitPrice, 
											'status' => $itemStatus, 
											'description' => $itemDescription, 
											'itemNumber' => $itemNumber]);
			
			/* edit item name in sale table */
			$editSale = "UPDATE sale SET itemName = '$itemName' WHERE itemNumber = '$itemNumber'";
			$updateSaleStatement = $dbcon->prepare($editSale);
			$updateSaleStatement->execute(['itemName' => $itemName, 'itemNumber' => $itemNumber]);
			
			/* edit item name in purchase */
			$editPurch = " UPDATE purchase SET itemName = '$itemName' WHERE itemNumber = '$itemNumber' ";
			$updatePurchStatement = $dbcon->prepare($editPurch);
			$updatePurchStatement->execute(['itemName' => $itemName, 'itemNumber' => $itemNumber]);
			
			$successAlert = '<div class="alert alert-success">
			                      <button type="button" class="close" data-dismiss="alert">&times;</button>
								  Item details updated.
							 </div>';
			$data = ['alertMessage' => $successAlert, 'newStock' => $newStock];
			echo json_encode($data);
			exit();
			
		} else {
			/* empty fields , display error message */
			$errorAlert = '<div class="alert alert-danger">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								Please enter all fields marked with a (*)
						   </div>';
			$data = ['alertMessage' => $errorAlert];
			echo json_encode($data);
			exit();
		}
	}
?>