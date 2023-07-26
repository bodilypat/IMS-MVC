<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');

	// Execute the script if the POST request is submitted
	if(isset($_POST['saleID'])){
		
		$saleID = htmlentities($_POST['saleID']);
		
		$saleQuery = 'SELECT * FROM sale WHERE saleID = :saleID';
		$saleStatement = $conn->prepare($saleDetailsSql);
		$saleStatement->execute(['saleID' => $saleID]);
		
		// If data is found for the given saleID, return it as a json object
		if($saleStatement->rowCount() > 0) {
			$row = $saleStatement->fetch(PDO::FETCH_ASSOC);
			echo json_encode($row);
		}
		$saleStatement->closeCursor();
	}
?>
