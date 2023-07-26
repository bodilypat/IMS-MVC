<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');

	// Execute the script if the POST request is submitted
	if(isset($_POST['purchaseID'])){
		
		$purchaseID = htmlentities($_POST['purchaseID']);
		
		$queryPurchase = 'SELECT * FROM purchase WHERE purchaseID = :purchaseID';
		$purchaseStatement = $conn->prepare($queryPurchase);
		$purchaseStatement->execute(['purchaseID' => $purchaseID]);
		
		// If data is found for the given purchaseID, return it as a json object
		if($purchaseStatement->rowCount() > 0) {
			$row = $purchaseStatement->fetch(PDO::FETCH_ASSOC);
			echo json_encode($row);
		}
		$purchaseStatement->closeCursor();
	}
?>
