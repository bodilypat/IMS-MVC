<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');

	// Execute the script if the POST request is submitted
	if(isset($_POST['venID'])){
		
		$vendorID = htmlentities($_POST['venID']);
		
		$venQuery = 'SELECT * FROM vendor WHERE vendorID = :vendorID';
		$venStatement = $conn->prepare($venQuery);
		$venStatement->execute(['vendorID' => $vendorID]);
		
		// If data is found for the given vendorID, return it as a json object
		if($venStatement->rowCount() > 0) {
			$row = $venStatement->fetch(PDO::FETCH_ASSOC);
			echo json_encode($row);
		}
		$venStatement->closeCursor();
	}
?>
    
