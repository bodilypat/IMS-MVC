<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');
	
	$saleQuery = "SELECT MAX(saleID) FROM sale";
	$statement = $conn->prepare($sql);
	$statement->execute();
	$row = $statement->fetch(PDO::FETCH_ASSOC);
	
	echo $row['MAX(saleID)'];
?>

