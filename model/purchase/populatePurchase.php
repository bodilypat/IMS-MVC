<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/dbconnect.php');

/*  Execute the script if the POST request is submitted */
	if(isset($_POST['purchaseID'])){
		
		$purchID = htmlentities($_POST['purchaseID']);
		
		$qPurch = 'SELECT * FROM purchase WHERE purchaseID = :purchID';
		$purchStatement = $dbcon->prepare($qPurchase);
		$purchStatement->execute(['purchaseID' => $purchID]);
		
		/* If data is found for the given purchaseID, return it as a json object */
		if($purchStatement->rowCount() > 0) {
			$recordPur = $purchStatement->fetch(PDO::FETCH_ASSOC);
			echo json_encode($recordPur);
		}
		$purchStatement->closeCursor();
	}
?>
