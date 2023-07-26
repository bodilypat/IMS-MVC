<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');

	// Execute the script if the POST request is submitted
	if(isset($_POST['itemNumber'])){
		
		$itemNumber = htmlentities($_POST['itemNumber']);
		
		$queryItem = 'SELECT * FROM item WHERE itemNumber = :itemNumber';
		$itemStatement = $conn->prepare($queryItem);
		$itemStatement->execute(['itemNumber' => $itemNumber]);
		
		// If data is found for the given item number, return it as a json object
		if($itemStatement->rowCount() > 0) {
			$row = $itemStatement->fetch(PDO::FETCH_ASSOC);
			echo json_encode($row);
		}
		$itemStatement->closeCursor();
	}
?>
