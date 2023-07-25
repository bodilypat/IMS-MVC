<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');

	// Execute the script if the POST request is submitted
	if(isset($_POST['custID'])){
		
		$customerID = htmlentities($_POST['custID']);
		
		$custQuery = 'SELECT * FROM customer WHERE customerID = :customerID';
		$custStatement = $conn->prepare($custQuery);
		$custStatement->execute(['customerID' => $customerID]);
		
		// If data is found for the given item number, return it as a json object
		if($custStatement->rowCount() > 0) {
			$row = $custStatement->fetch(PDO::FETCH_ASSOC);
			echo json_encode($row);
		}
		$custStatement->closeCursor();
	}
?>
    
