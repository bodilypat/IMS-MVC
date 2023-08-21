<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');
	
	$qVendor = "SELECT MAX(vendorID) FROM vendor";
	$vendorStatement = $conn->prepare($query);
	$vendorStatement->execute();
	$result = $vendorStatement->fetch(PDO::FETCH_ASSOC);
	
	echo $row['MAX(vendorID)'];
	$vendorStatement->closeCursor();
?>