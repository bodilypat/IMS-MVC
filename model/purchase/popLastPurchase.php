<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');
	
	$qPurchase = "SELECT MAX(purchaseID) FROM purchase";
	$purchaseStatement = $conn->prepare($qPurchase);
	$purchaseStatement->execute();
	$result = $purchaseStatement->fetch(PDO::FETCH_ASSOC);
	
	echo $result['MAX(purchaseID)'];
?>
