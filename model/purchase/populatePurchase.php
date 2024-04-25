<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/dbconnect.php');

	if(isset($_POST['purchaseID'])){
		
		$purchaseID = htmlentities($_POST['purchaseID']);
		
		$qPurch = " SELECT * FROM purchase WHERE purchaseID = '$purchaseID'";
		$purchStatement = $conn->prepare($qPurch);
		$purchStatement->execute(['purchaseID' => $purchaseID]);
		
		/* get purchase object from database, return by json object */
		if($purchStatement->rowCount() > 0) {
			$resultset = $purchStatement->fetch(PDO::FETCH_ASSOC);
			echo json_encode($resultset);
		}
		$purchStatement->closeCursor();
	}
?>