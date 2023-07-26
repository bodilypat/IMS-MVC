<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');
	
	$query = "SELECT MAX(vendorID) FROM vendor";
	$statement = $conn->prepare($query);
	$statement->execute();
	$row = $statement->fetch(PDO::FETCH_ASSOC);
	
	echo $row['MAX(vendorID)'];
	$statement->closeCursor();
?>
