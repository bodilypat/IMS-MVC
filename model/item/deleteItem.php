<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/dbconnect.php');
	
	$itemNumber = htmlentities($_POST['itemNumber']);
	
	if(isset($_POST['itemNumber'])){
		
		/* Check if mandatory fields are not empty  */
		if(!empty($itemNumber)){
			
		
			/*  Sanitize item number */
			$itemNumber = filter_var($itemNumber, FILTER_SANITIZE_STRING);

			/* get item object from database */
			$qItem = "SELECT itemNumber FROM item WHERE itemNumber='$itemNumber'";
			$itemStatement = $conn->prepare($queryItem);
			$itemStatement->execute(['itemNumber' => $itemNumber]);
			
			if($itemStatement->rowCount() > 0){
		
				/* item exists in database, start delete process */
				$delItem = "DELETE FROM item WHERE itemNumber='$itemNumber'";
				$delStatement = $dbcon->prepare($delItem);
				$delStatement->execute(['itemNumber' => $itemNumber]);

				echo '<div class="alert alert-success">
				          <button type="button" class="close" data-dismiss="alert">&times;</button>
					  Item deleted.</div>';
				exit();
				
			} else {
				
				echo '<div class="alert alert-danger">
						   <button type="button" class="close" data-dismiss="alert">&times;</button>
							Item does not exist in DB. Therefore, can\'t delete.
					  </div>';
				exit();
			}
			
		} else {
			
			echo '<div class="alert alert-danger">
			           <button type="button" class="close" data-dismiss="alert">&times;</button>
					   Please enter the item number
				  </div>';
			exit();
		}
	}
?>
