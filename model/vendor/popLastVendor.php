<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');
	
	$qVendor = "SELECT MAX(vendorID) FROM vendor";
	$getVendorStatement = $conn->prepare($query);
	$getVendorStatement->execute();
	$result = $vendorStatement->fetch(PDO::FETCH_ASSOC);
	
	echo $result['MAX(vendorID)'];
	$vendorStatement->closeCursor();
?>
