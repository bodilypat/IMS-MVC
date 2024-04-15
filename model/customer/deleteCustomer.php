<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/dbconnect.php');
	
	if(isset($_POST['customerID'])){
		
		$custID = htmlentities($_POST['customerID']);
		
		/*  Check if mandatory fields are not empty */
		if(!empty($custID)){
			
			/*  Sanitize customerID */
			$custID = filter_var($custID, FILTER_SANITIZE_STRING);

			/*  Check if the customer is in the database */
			$qCust = 'SELECT customerID FROM customer WHERE customerID=:custID';
			$custStatement = $dbcon->prepare($qCust);
			$custStatement->execute(['customerID' => $custID]);
			
			if($custStatement->rowCount() > 0){
				
				/* Customer exists in DB. Hence start the DELETE process */
				$delCust = 'DELETE FROM customer WHERE customerID=:custID';
				$custStatement = $dbcon->prepare($delCust);
				$custStatement->execute(['customerID' => $custID]);

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
