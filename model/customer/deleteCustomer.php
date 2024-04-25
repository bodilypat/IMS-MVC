<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/db.php');
	
	if(isset($_POST['customerID'])){
		
		$customerID = htmlentities($_POST['customerID']);
		
		/* check mandatory filed */
		if(!empty($customerD)){
			
			/* sanitize customerID */
			$customerID = filter_var($customerID, FILTER_SANITIZE_STRING);

			/* get customer object in database */
			$qCust = "SELECT customerID FROM customer WHERE customerID= '$customerID'";
			$custStatement = $dbcon->prepare($qCust);
			$custStatement->execute(['customerID' => $customerID]);
			
			if($custStatement->rowCount() > 0){
				
				/* customse exist in database,  star delete  process */
				$delCust = " DELETE FROM customer WHERE customerID= '$customerID'";
				$delStatement = $dbcon->prepare($delCust);
				$delStatement->execute(['customerID' => $customerID]);

				echo '<div class="alert alert-success">
				          <button type="button" class="close" data-dismiss="alert">&times;</button>
						  Customer deleted.
					  </div>';
				exit();
				
			} else {
				/* customer does not exist */
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>
					       Customer does not exist in DB. Therefore, can\'t delete.
					  </div>';
				exit();
			}
			
		} else {
			
			echo '<div class="alert alert-danger">
			           <button type="button" class="close" data-dismiss="alert">&times;</button>
					   Please enter the CustomerID
				 </div>';
			exit();
		}
	}
?>