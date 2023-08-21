<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');
	
	$qItem = "SELECT MAX(productID) FROM item";
	$itemStatement = $conn->prepare($qItem);
	$itemStatementt->execute();
	$result = $itemStatement->fetch(PDO::FETCH_ASSOC);
	
	echo $result['MAX(productID)'];
	$itemStatement->closeCursor();
?>
