<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/dbconnect.php');

/*  Execute the script if the POST request is submitted */
	if(isset($_POST['purchaseID'])){
		
		$purchaseID = htmlentities($_POST['purchaseID']);
		
		$qPurch = 'SELECT * FROM purchase WHERE purchaseID = :purchaseID';
		$purchStatement = $dbcon->prepare($qPurch);
		$purchStatement->execute(['purchaseID' => $purchaseID]);
		
		/* If data is found for the given purchaseID, return it as a json object */
		if($purchStatement->rowCount() > 0) {
			$result = $purchStatement->fetch(PDO::FETCH_ASSOC);
			echo json_encode($result);
		}
		$purchStatement->closeCursor();
	}
?>
