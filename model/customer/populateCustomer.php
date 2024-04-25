<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/dbconnect.php');

	/* Execute the script if the POST request is submitted */
	if(isset($_POST['customerID'])){
		
		$customerID = htmlentities($_POST['customerID']);
		
		$qCust = " SELECT * FROM customer WHERE customerID = '$customerID'";
		$custStatement = $conn->prepare($custQuery);
		$custStatement->execute(['customerID' => $customerID]);
		
		/* get customer object  from database , return object by json */
		if($custStatement->rowCount() > 0) {
			$resultset = $custStatement->fetch(PDO::FETCH_ASSOC);
			echo json_encode($resultset);
		}
		$custStatement->closeCursor();
	}
?>