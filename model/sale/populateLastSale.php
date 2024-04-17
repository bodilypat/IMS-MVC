<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/dbconnect.php');
	
	$qSale = "SELECT MAX(saleID) FROM sale";
	$saleStatement = $dbcon->prepare($qSale);
	$saleStatement->execute();
	$result = $saleStatement->fetch(PDO::FETCH_ASSOC);
	
	echo $row['MAX(saleID)'];
?>

