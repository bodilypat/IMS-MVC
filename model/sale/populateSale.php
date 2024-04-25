<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/dbconnect.php');

	if(isset($_POST['saleID'])){
		
		$saleID = htmlentities($_POST['saleID']);
		
		$qSale = "SELECT * FROM sale WHERE saleID = '$saleID'";
		$saleStatement = $dbcon->prepare($qSale);
		$saleStatement->execute(['saleID' => $saleID]);
		
		/* get sale object from database, return it by json object */
		if($saleStatement->rowCount() > 0) {
			$resultset = $saleStatement->fetch(PDO::FETCH_ASSOC);
			echo json_encode($resultset);
		}
		$saleStatement->closeCursor();
	}
?>