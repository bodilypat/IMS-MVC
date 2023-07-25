<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');
	
	if(isset($_POST['custID'])){
		
		$customerID = htmlentities($_POST['custID']);
		
		// Check if mandatory fields are not empty
		if(!empty($customerD)){
			
			// Sanitize customerID
			$customerID = filter_var($customerID, FILTER_SANITIZE_STRING);

			// Check if the customer is in the database
			$custQuery = 'SELECT customerID FROM customer WHERE customerID=:customerID';
			$custStatement = $conn->prepare($custQuery);
			$custStatement->execute(['customerID' => $customerID]);
			
			if($custStatement->rowCount() > 0){
				
				// Customer exists in DB. Hence start the DELETE process
				$deleteCust = 'DELETE FROM customer WHERE customerID=:customerID';
				$deleteCustStatement = $conn->prepare($deleteCust);
				$deleteCustStatement->execute(['customerID' => $customerID]);

				echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Customer deleted.</div>';
				exit();
				
			} else {
				// Customer does not exist, therefore, tell the user that he can't delete that customer 
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Customer does not exist in DB. Therefore, can\'t delete.</div>';
				exit();
			}
			
		} else {
			// CustomerID is empty. Therefore, display the error message
			echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter the CustomerID</div>';
			exit();
		}
	}
?>