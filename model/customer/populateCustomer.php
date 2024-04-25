<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/dbconnect.php');

	/* Execute the script if the POST request is submitted */
	if(isset($_POST['customerID'])){
		
		$customerID = htmlentities($_POST['customerID']);
		
		$qCust= 'SELECT * FROM customer WHERE customerID = :customerID';
		$custStatement = $dbcon->prepare($qCust);
		$custStatement->execute(['customerID' => $customerID]);
		
		/*  If data is found for the given item number, return it as a json object */
		if($custStatement->rowCount() > 0) {
			$result = $custStatement->fetch(PDO::FETCH_ASSOC);
			echo json_encode($result);
		}
		$custStatement->closeCursor();
	}
?>
