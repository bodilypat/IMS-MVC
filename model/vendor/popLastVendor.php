<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/dbconnect.php');
	
	$qVen = "SELECT MAX(vendorID) FROM vendor";
	$venStatement = $dbcon->prepare($query);
	$enStatement->execute();
	$result = $venStatement->fetch(PDO::FETCH_ASSOC);
	
	echo $result['MAX(vendorID)'];
	$venStatement->closeCursor();
?>
