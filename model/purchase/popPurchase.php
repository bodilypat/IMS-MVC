<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');

/*  Execute the script if the POST request is submitted */
	if(isset($_POST['purchaseID'])){
		
		$purchaseID = htmlentities($_POST['purchaseID']);
		
		$qPurchase = 'SELECT * FROM purchase WHERE purchaseID = :purchaseID';
		$purchaseStatement = $conn->prepare($qPurchase);
		$purchaseStatement->execute(['purchaseID' => $purchaseID]);
		
		/* If data is found for the given purchaseID, return it as a json object */
		if($purchaseStatement->rowCount() > 0) {
			$result = $purchaseStatement->fetch(PDO::FETCH_ASSOC);
			echo json_encode($result);
		}
		$purchaseStatement->closeCursor();
	}
?>
