<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/dbconnect.php');

	/* Execute the script if the POST request is submitted */
	if(isset($_POST['venID'])){
		
		$vendorID = htmlentities($_POST['venID']);
		
		$qVen = 'SELECT * FROM vendor WHERE vendorID = :vendorID';
		$venStatement = $dbcon->prepare($qVendor);
		$venStatement->execute(['vendorID' => $vendorID]);
		
		/* If data is found for the given vendorID, return it as a json object */
		if($venStatement->rowCount() > 0) {
			$result = $venStatement->fetch(PDO::FETCH_ASSOC);
			echo json_encode($result);
		}
		$venStatement->closeCursor();
	}
?>
