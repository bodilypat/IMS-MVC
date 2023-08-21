<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');
	
	$itemNumber = htmlentities($_POST['itemNumber']);
	
	if(isset($_POST['itemNumber'])){
		
		/*  Check if mandatory fields are not empty */
		if(!empty($itemNumber)){
						
			$itemNumber = filter_var($itemNumber, FILTER_SANITIZE_STRING);

			/*  Check if the item is in the database */
			$qItem = 'SELECT itemNumber FROM item WHERE itemNumber=:itemNumber';
			$itemStatement = $conn->prepare($qItem);
			$itemStatement->execute(['itemNumber' => $itemNumber]);
			
			if($itemStatement->rowCount() > 0){
				
				/* Item exists in DB. Hence start the DELETE process */
				$delItem = 'DELETE FROM item WHERE itemNumber=:itemNumber';
				$delItemStatement = $conn->prepare($delItem);
				$delItemStatement->execute(['itemNumber' => $itemNumber]);

				echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Item deleted.</div>';
				exit();
				
			} else {
				/*  Item does not exist. can't delete that item */ 
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Item does not exist in DB. Therefore, can\'t delete.</div>';
				exit();
			}
			
		} else {
			/*  Item number is empty. display the error message */
			echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter the item number</div>';
			exit();
		}
	}
?>
