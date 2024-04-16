<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/dbconnect.php');

	// Execute the script if the POST request is submitted
	if(isset($_POST['saleID'])){
		
		$saleID = htmlentities($_POST['saleID']);
		
		$qSale = 'SELECT * FROM sale WHERE saleID = :saleID';
		$saleStatement = $conn->prepare($qSale);
		$saleStatement->execute(['saleID' => $saleID]);
		
		// If data is found for the given saleID, return it as a json object
		if($saleStatement->rowCount() > 0) {
			$recordSale = $saleStatement->fetch(PDO::FETCH_ASSOC);
			echo json_encode($recordSale);
		}
		$saleStatement->closeCursor();
	}
?>
