<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/dbconnect.php');
	
	$qCust = "SELECT MAX(customerID) FROM customer";
	$custStatementt = $dbcon->prepare($qCust);
	$custStatement->execute();
	$result = $custStatement->fetch(PDO::FETCH_ASSOC);
	
	echo $result['MAX(customerID)'];
	$custStatement->closeCursor();
?>