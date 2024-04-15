<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/dbconnect.php');
	
	$itemNum = htmlentities($_POST['itemNumber']);
	
	if(isset($_POST['itemNum'])){
		
		/*  Check if mandatory fields are not empty */
		if(!empty($itemNum)){
						
			$itemNum = filter_var($itemNum, FILTER_SANITIZE_STRING);

			/*  Check if the item is in the database */
			$qItem = 'SELECT itemNumber FROM item WHERE itemNumber=:itemNum';
			$itemStatement = $conn->prepare($qItem);
			$itemStatement->execute(['itemNumber' => $itemNum]);
			
			if($itemStatement->rowCount() > 0){
				
				/* Item exists in DB. Hence start the DELETE process */
				$delItem = 'DELETE FROM item WHERE itemNumber=:itemNum';
				$itemStatement = $dbcon->prepare($delItem);
				$itemStatement->execute(['itemNumber' => $itemNum]);

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
