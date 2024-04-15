<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/dbconnect.php');
	
	$qItem = "SELECT MAX(productID) FROM item";
	$itemStatement = $dbcon->prepare($qItem);
	$itemStatementt->execute();
	$result = $itemStatement->fetch(PDO::FETCH_ASSOC);
	
	echo $result['MAX(productID)'];
	$itemStatement->closeCursor();
?>
