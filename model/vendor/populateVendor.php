<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/dbconnect.php');

	/* Execute the script if the POST request is submitted */
	if(isset($_POST['vendorID'])){
		
		$venID = htmlentities($_POST['vendorID']);
		
		$qVen = 'SELECT * FROM vendor WHERE vendorID = :venID';
		$venStatement = $dbcon->prepare($qVen);
		$venStatement->execute(['vendorID' => $venID]);
		
		/* If data is found for the given vendorID, return it as a json object */
		if($venStatement->rowCount() > 0) {
			$recordVen = $venStatement->fetch(PDO::FETCH_ASSOC);
			echo json_encode($recordVen);
		}
		$venStatement->closeCursor();
	}
?>
