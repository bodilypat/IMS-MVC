<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/dbconnect.php');
	
	$balanceStock = 0;
	$baseImageFolder = '../../data/item_images/';
	$itemImageFolder = '';
	
	if(isset($_POST['itemNumber']))
	{
		
		$itemNumber = htmlentities($_POST['itemNumber']);
		$itemName = htmlentities($_POST['itemName']);
		$itemDiscount = htmlentities($_POST['itemDiscount']);
		$itemQuantity = htmlentities($_POST['itemQuantity']);
		$itemUnitPrice = htmlentities($_POST['itemUnitPrice']);
		$itemStatus = htmlentities($_POST['itemStatus']);
		$itemDescription = htmlentities($_POST['itemDescription']);
		
		/* Check if mandatory fields are not empty */
		if(!empty($itemNumber) && !empty($itemName) && isset($itemQuantity) && isset($itemUnitPrice)){
			
			/*  Sanitize item number */
			$itemNumber = filter_var($itemNumber, FILTER_SANITIZE_STRING);
			
			/*  Validate item quantity. It has to be a number */
			if(filter_var($itemQuantity, FILTER_VALIDATE_INT) === 0 || filter_var($itemQuantity, FILTER_VALIDATE_INT)){
				
			} else {
				
				echo '<div class="alert alert-danger">
				          <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for quantity
					  </div>';
				exit();
			}
					
			if(filter_var($itemUnitPrice, FILTER_VALIDATE_FLOAT) === 0.0 || filter_var($itemUnitPrice, FILTER_VALIDATE_FLOAT)){			
			} else {
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for unit price
					  </div>';
				exit();
			}
			
			if(!empty($itemDiscount)){
				if(filter_var($itemDiscount, FILTER_VALIDATE_FLOAT) === false){
					echo '<div class="alert alert-danger">
					          <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid discount amount
						  </div>';
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
			/*  get record item form database */
			$qItem = 'SELECT stock FROM item WHERE itemNumber=:itemNumber';
			$itemStatement = $dbcon->prepare($qItem);
			$itemStatement->execute(['itemNumber' => $itemNumber]);
			
			if($itemStatement->rowCount() > 0){				
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>Item already exists in DB. Please click the <strong>Update</strong> button to update the details. Or use a different Item Number.
					  </div>';
				exit();
			} else {
								
				$addItem = 'INSERT INTO item(itemNumber, itemName, discount, stock, unitPrice, status, description) 
				            VALUES(:itemNumber, :itemName, :itemDiscount, :itemStock, :itemUnitPrice, :itemStatus, :itemDescription)';
				$itemStatement = $dbcon->prepare($addItem);
				$itemStatement->execute(['itemNumber' => $itemNumber, 
				                         'itemName' => $itemName, 
										 'discount' => $itemDiscount, 
										 'stock' => $itemQuantity, 
										 'unitPrice' => $itemUnitPrice, 
										 'status' => $itemStatus, 
										 'description' => $itemDescription]);
				echo '<div class="alert alert-success">
				            <button type="button" class="close" data-dismiss="alert">&times;</button>Item added to database.
				      </div>';
				exit();
			}

		} else {
			/* One or more mandatory fields are empty. Therefore, display a the error message */
			echo '<div class="alert alert-danger">
			           <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter all fields marked with a (*)
				  </div>';
			exit();
		}
	}
?>