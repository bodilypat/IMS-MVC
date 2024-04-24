<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/dbconnect.php');

	// Execute the script if the POST request is submitted
	if(isset($_POST['saleID'])){
		
		$saleID = htmlentities($_POST['saleID']);
		
		$qSale = 'SELECT * FROM sale WHERE saleID = :saleID';
		$saleStatement = $dbcon->prepare($qSale);
		$saleStatement->execute(['saleID' => $saleID]);
		
		// If data is found for the given saleID, return it as a json object
		if($saleStatement->rowCount() > 0) {
			$result = $saleStatement->fetch(PDO::FETCH_ASSOC);
			echo json_encode($result);
		}
		$saleStatement->closeCursor();
	}
?>
