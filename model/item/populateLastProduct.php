<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/dbconnect.php');
	
	$qItem = "SELECT MAX(productID) FROM item";
	$itemStatement = $dbcon->prepare($qItem);
	$itemStatementt->execute();
	$result = $itemStatement->fetch(PDO::FETCH_ASSOC);
	/* get result productID */
	echo $result['MAX(productID)'];
	$itemStatement->closeCursor();
?>