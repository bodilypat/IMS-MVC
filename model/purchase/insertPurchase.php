<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/dbconnect.php');
	
	if(isset($_POST['purchItemNumber'])){

		$purchItemNumber = htmlentities($_POST['purchItemNumber']);
		$purchDate = htmlentities($_POST['purchDate']);
		$purchItemName = htmlentities($_POST['purchItemName']);
		$purchQuantity = htmlentities($_POST['purchQuantity']);
		$purchUnitPrice = htmlentities($_POST['purchUnitPrice']);
		$purchVendorName = htmlentities($_POST['purchVendorName']);
		
		$balanceStock = 0;
		$newStock = 0;
		
		/* Check if mandatory fields are not empty */
		if(isset($purchItemNumber) && isset($purchDate) && isset($purchItemName) && isset($purchQuantity) && isset($purchUnitPrice)){
			
			if($purchItemNumber == ''){ 
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>
						   Please enter Item Number.
					  </div>';
				exit();
			}
						
			if($purchItemName == ''){ 
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>
						   Please enter Item Name.
					  </div>';
				exit();
			}
			
			if($purchQuantity == ''){ 
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>
						   Please enter Quantity.
					  </div>';
				exit();
			}
			
			
			if($purchUnitPrice == ''){ 
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>
						   Please enter Unit Price.
					  </div>';
				exit();
			}
			
			$purchItemNumber = filter_var($purchItemNumber, FILTER_SANITIZE_STRING);
			
			if(filter_var($purchQuantity, FILTER_VALIDATE_INT) === 0 || filter_var($purchQuantity, FILTER_VALIDATE_INT)){
			} else {
				/* Quantity is not a valid number */
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for quantity.
					  </div>';
				exit();
			}
			
			/* Validate unit price. It has to be an integer or floating point value */
		    if(filter_var($purchUnitPrice, FILTER_VALIDATE_FLOAT) === 0.0 || filter_var($purchUnitPrice, FILTER_VALIDATE_FLOAT)){
				
			} else {
				
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for unit price.
					  </div>';
				exit();
			}
						 
			/* get object item from database by item number */
			$qItem= "SELECT stock FROM item WHERE itemNumber= '$purchItemNumber'";
			$itemStatement = $dbcon->prepare($qItem);
			$itemStatement->execute(['itemNumber' => $purchItemNumber]);

			if($itemStatement->rowCount() > 0){
				
				/* Get object vendorID from database by vendername*/
				
				$qVen = "SELECT * FROM vendor WHERE fullName = '$purchVendorName'";
				$venStatement = $dbcon->prepare($qVen);
				$venStatement->execute(['fullName' => $purchVendorName]);

				$resultVen = $venStatement->fetch(PDO::FETCH_ASSOC);
				$vendorID = $resultVen['vendorID'];
				
				/*  Item exits in the item table, inserting data to purchase table */
				$addPur = "INSERT INTO purchase(itemNumber, purchaseDate, itemName, unitPrice, quantity, vendorName, vendorID) 
				           VALUES('$purchItemNumber','$purchDate','$purchItemName','$purchUnitPrice','$purchQuantity','$purchVendor','$purchVendor','$purchVendor')";
				$purStatement = $dbcon->prepare($addPur);
				$purStatement->execute(['itemNumber' => $purchItemNumber, 
				                        'purchaseDate' => $purchDate, 
										'itemName' => $purchItemName, 
										'unitPrice' => $purchUnitPrice, 
										'quantity' => $purchQuantity, 
										'vendorName' => $purchVendorName, 
										'vendorID' => $vendorID]);
				
				/*  get object item from database */
				$resultItem = $itemStatement->fetch(PDO::FETCH_ASSOC);
				$balanceStock = $resultItem['stock'];
				$newStock = $balanceStock + $purchQuantity;
				
				/* update  the new stock value in item table by ItemNumber */
				$editItem = "UPDATE item SET stock = :stock WHERE itemNumber = '$purchItemNumber'";
				$itemStatement = $dbcon->prepare($editItem);
				$itemStatement->execute(['stock' => $newStock, 'itemNumber' => $purchItemNumber]);
				
				echo '<div class="alert alert-success">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>
						           Purchase details added to database and stock values updated.
					  </div>';
				exit();
				
			} else {
				/* Item does not exist in item table */ 
				/*  to add it to DB as a new purchase */
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>
						   Item does not exist in DB. Therefore, first enter this item to DB using the <strong>Item</strong> tab.
					  </div>';
				exit();
			}

		} else {
			/* One or more mandatory fields are empty. display a the error message */
			echo '<div class="alert alert-danger">
			           <button type="button" class="close" data-dismiss="alert">&times;</button>
					   Please enter all fields marked with a (*)
				  </div>';
			exit();
		}
	}
?>