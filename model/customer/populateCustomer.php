<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/dbconnect.php');

	/* Execute the script if the POST request is submitted */
	if(isset($_POST['customerID'])){
		
		$custID = htmlentities($_POST['customerID']);
		
		$qCust= 'SELECT * FROM customer WHERE customerID = :custID';
		$custStatement = $dbcon->prepare($qCust);
		$custStatement->execute(['customerID' => $custID]);
		
		/*  If data is found for the given item number, return it as a json object */
		if($custStatement->rowCount() > 0) {
			$recordCust = $custStatement->fetch(PDO::FETCH_ASSOC);
			echo json_encode($recordCust);
		}
		$custStatement->closeCursor();
	}
?>
