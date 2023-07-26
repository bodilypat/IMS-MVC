<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');
	
	$query = "SELECT MAX(productID) FROM item";
	$statement = $conn->prepare($query);
	$statementt->execute();
	$row = $statement->fetch(PDO::FETCH_ASSOC);
	
	echo $row['MAX(productID)'];
	$statement->closeCursor();
?>
