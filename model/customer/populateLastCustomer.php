<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');
	
	$qCust = "SELECT MAX(customerID) FROM customer";
	$custStatementt = $conn->prepare($qCust);
	$cuustStatement->execute();
	$row = $custStatement->fetch(PDO::FETCH_ASSOC);
	
	echo $row['MAX(customerID)'];
	$custStatement->closeCursor();
?>