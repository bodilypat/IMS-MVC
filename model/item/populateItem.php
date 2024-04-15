<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/dbconnect.php');

	/*  Execute  POST request is submitted */
	if(isset($_POST['itemNumber'])){
		
		$itemNum = htmlentities($_POST['itemNumber']);
		
		$qItem = 'SELECT * FROM item WHERE itemNumber = :itemNum';
		$itemStatement = $dbcon->prepare($qItem);
		$itemStatement->execute(['itemNumber' => $itemNum]);
		
		/*  If data is found for the given item number, return it as a json object */
		if($itemStatement->rowCount() > 0) {
			$recordItem = $itemStatement->fetch(PDO::FETCH_ASSOC);
			echo json_encode($recordItem);
		}
		$itemStatement->closeCursor();
	}
?>
