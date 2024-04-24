<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/dbconnect.php');
	
	if(isset($_POST['customerID'])){
		
		$customerID = htmlentities($_POST['customerID']);
		
		/*  Check if mandatory fields are not empty */
		if(!empty($customerID)){
			
			/*  Sanitize customerID */
			$customerID = filter_var($custID, FILTER_SANITIZE_STRING);

			/*  Check if the customer is in the database */
			$qCust = 'SELECT customerID FROM customer WHERE customerID=:customerID';
			$custStatement = $dbcon->prepare($qCust);
			$custStatement->execute(['customerID' => $customerID]);
			
			if($custStatement->rowCount() > 0){
				
				/* Customer exists in DB. Hence start the DELETE process */
				$delCust = 'DELETE FROM customer WHERE customerID=:customerID';
				$delStatement = $dbcon->prepare($delCust);
				$delStatement->execute(['customerID' => $customerID]);

				echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Customer deleted.</div>';
				exit();
				
			} else {
				/*  Customer does not exist, therefore, tell the user that he can't delete that customer */ 
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Customer does not exist in DB. Therefore, can\'t delete.</div>';
				exit();
			}
			
		} else {
			/* CustomerID is empty. Therefore, display the error message */
			echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter the CustomerID</div>';
			exit();
		}
	}
?>
