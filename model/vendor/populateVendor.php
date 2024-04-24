<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');

	// Execute the script if the POST request is submitted
	if(isset($_POST['vendorID'])){
		
		$vendorID = htmlentities($_POST['vendorID']);
		
		$qVen = 'SELECT * FROM vendor WHERE vendorID = :vendorID';
		$venStatement = $dbcon->prepare($qVen);
		$venStatement->execute(['vendorID' => $vendorID]);
		
		// If data is found for the given vendorID, return it as a json object
		if($venStatement->rowCount() > 0) {
			$result = $venStatement->fetch(PDO::FETCH_ASSOC);
			echo json_encode($result);
		}
		$venStatement->closeCursor();
	}
?>