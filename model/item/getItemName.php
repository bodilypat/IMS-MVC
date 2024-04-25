<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/db.php');

	// Execute the script if the POST request is submitted
	if(isset($_POST['itemNumber'])){
		
		$itemNumber = htmlentities($_POST['itemNumber']);
		
		$queryItem = "SELECT * FROM item WHERE itemNumber = '$itemNumber'";
		$itemStatement = $dbcon->prepare($queryItem);
		$itemStatement->execute(['itemNumber' => $itemNumber]);
		
		// get item object , return it as a json object
		if($itemStatement->rowCount() > 0) {
			$resultset = $itemStatement->fetch(PDO::FETCH_ASSOC);
			echo json_encode($resultset);
		}
		$itemStatement->closeCursor();
	}
?>