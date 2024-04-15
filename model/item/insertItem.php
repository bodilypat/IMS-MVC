<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/dbconnect.php');
	
	$balanceStock = 0;
	$baseImageFolder = '../../data/item_images/';
	$itemImageFolder = '';
	
	if(isset($_POST['itemDetailsItemNumber']))
	{
		
		$itemNum = htmlentities($_POST['itemNumber']);
		$itemName = htmlentities($_POST['itemName']);
		$itemDiscount = htmlentities($_POST['itemDiscount']);
		$itemQuantity = htmlentities($_POST['itemQuantity']);
		$itemUnitPrice = htmlentities($_POST['itemUnitPrice']);
		$itemStatus = htmlentities($_POST['itemStatus']);
		$itemDes = htmlentities($_POST['itemDescription']);
		
		/* Check if mandatory fields are not empty */
		if(!empty($itemNum) && !empty($itemName) && isset($itemquantity) && isset($itemUnitPrice)){
			
			/*  Sanitize item number */
			$itemNum = filter_var($itemNum, FILTER_SANITIZE_STRING);
			
			/*  Validate item quantity. It has to be a number */
			if(filter_var($itemQuantity, FILTER_VALIDATE_INT) === 0 || filter_var($itemQuantity, FILTER_VALIDATE_INT)){
				
			} else {
				
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for quantity</div>';
				exit();
			}
					
			if(filter_var($itemUnitPrice, FILTER_VALIDATE_FLOAT) === 0.0 || filter_var($itemUnitPrice, FILTER_VALIDATE_FLOAT)){			
			} else {
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for unit price</div>';
				exit();
			}
			
			if(!empty($itemDiscount)){
				if(filter_var($itemDiscount, FILTER_VALIDATE_FLOAT) === false){
					echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid discount amount</div>';
					exit();
				}
			}
			
			/* Create image folder for uploading images */
			$itemImageFolder = $baseImageFolder . $itemNum;
			if(is_dir($itemImageFolder)){
				/*  Folder already exist. do nothing */
			} else {
				/*  Folder does not exist, create it */
				mkdir($itemImageFolder);
			}			
			/*  Calculate the stock values */
			$qITEMk = 'SELECT stock FROM item WHERE itemNumber=:itemNum';
			$itemStatement = $dbcon->prepare($qItem);
			$itemStatement->execute(['itemNumber' => $itemNum]);
			if($itemStatement->rowCount() > 0){				
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Item already exists in DB. Please click the <strong>Update</strong> button to update the details. Or use a different Item Number.</div>';
				exit();
			} else {
								
				$addItem = 'INSERT INTO item(itemNumber, itemName, discount, stock, unitPrice, status, description) 
                                            VALUES(:itemNum, :itemName, :itemDiscount, :itemStock, :itemUnitPrice, :itemStatus, :itemDes)';
				$itemStatement = $dbcon->prepare($addItem);
				$itemStatement->execute(['itemNumber' => $itemNum, 
							'itemName' => $itemName, 
							'discount' => $itemDiscount, 
							'stock' => $itemQuantity, 
							'unitPrice' => $itemUnitPrice, 
							'status' => $itemStatus, 
							'description' => $itemDes]);
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
