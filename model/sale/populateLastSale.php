<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/dbconnect.php');
	
	$qSale = "SELECT MAX(saleID) FROM sale";
	$saleStatement = $dbcon->prepare($qSale);
	$saleStatement->execute();
	/* get saleID form database */
	$result= $saleStatement->fetch(PDO::FETCH_ASSOC);
	
	echo $result['MAX(saleID)'];
?>