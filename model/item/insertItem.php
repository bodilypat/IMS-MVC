<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');
	
	$initialStock = 0;
	$baseImageFolder = '../../data/item_images/';
	$itemImageFolder = '';
	
	if(isset($_POST['itemDetailsItemNumber']))
	{
		
		$itemNumber = htmlentities($_POST['itemNumber']);
		$itemName = htmlentities($_POST['itemName']);
		$discount = htmlentities($_POST['itemDiscount']);
		$quantity = htmlentities($_POST['itemQuantity']);
		$unitPrice = htmlentities($_POST['itemUnitPrice']);
		$status = htmlentities($_POST['itemStatus']);
		$description = htmlentities($_POST['itemDescription']);
		
		/* Check if mandatory fields are not empty */
		if(!empty($itemNumber) && !empty($itemName) && isset($quantity) && isset($unitPrice)){
			
			/*  Sanitize item number */
			$itemNumber = filter_var($itemNumber, FILTER_SANITIZE_STRING);
			
			/*  Validate item quantity. It has to be a number */
			if(filter_var($quantity, FILTER_VALIDATE_INT) === 0 || filter_var($quantity, FILTER_VALIDATE_INT)){
				
			} else {
				
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for quantity</div>';
				exit();
			}
					
			if(filter_var($unitPrice, FILTER_VALIDATE_FLOAT) === 0.0 || filter_var($unitPrice, FILTER_VALIDATE_FLOAT)){			
			} else {
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for unit price</div>';
				exit();
			}
			
			if(!empty($discount)){
				if(filter_var($discount, FILTER_VALIDATE_FLOAT) === false){
					echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid discount amount</div>';
					exit();
				}
			}
			
			/* Create image folder for uploading images */
			$itemImageFolder = $baseImageFolder . $itemNumber;
			if(is_dir($itemImageFolder)){
				/*  Folder already exist. do nothing */
			} else {
				/*  Folder does not exist, create it */
				mkdir($itemImageFolder);
			}			
			/*  Calculate the stock values */
			$qStock = 'SELECT stock FROM item WHERE itemNumber=:itemNumber';
			$itemStatement = $conn->prepare($qStock);
			$itemStatement->execute(['itemNumber' => $itemNumber]);
			if($stockStatement->rowCount() > 0){				
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Item already exists in DB. Please click the <strong>Update</strong> button to update the details. Or use a different Item Number.</div>';
				exit();
			} else {
								
				$addItem = 'INSERT INTO item(itemNumber, itemName, discount, stock, unitPrice, status, description) VALUES(:itemNumber, :itemName, :discount, :stock, :unitPrice, :status, :description)';
				$insertItemStatement = $conn->prepare($addItem);
				$insertItemStatement->execute(['itemNumber' => $itemNumber, 'itemName' => $itemName, 'discount' => $discount, 'stock' => $quantity, 'unitPrice' => $unitPrice, 'status' => $status, 'description' => $description]);
				echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Item added to database.</div>';
				exit();
			}

		} else {
			/* One or more mandatory fields are empty. Therefore, display a the error message */
			echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter all fields marked with a (*)</div>';
			exit();
		}
	}
?>
