<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/dbconnect.php');
	
	$qPurch = "SELECT MAX(purchaseID) FROM purchase";
	$purchStatement = $dbcon->prepare($qPurch);
	$purchStatement->execute();

	/* get result purchaseID */
	$result = $purchStatement->fetch(PDO::FETCH_ASSOC);
	
	echo $result['MAX(purchaseID)'];
?>