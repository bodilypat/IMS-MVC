<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/dbconnect.php');

	/* Execute the script if the POST request is submitted */
	if(isset($_POST['vendorID'])){
		
		$vendorID = htmlentities($_POST['vendorID']);
		
		$qVen = " SELECT * FROM vendor WHERE vendorID = '$vendorID'";
		$venStatement = $dbcon->prepare($qVen);
		$venStatement->execute(['vendorID' => $vendorID]);
		
		/* get vendor object from databse, return by json */
		if($venStatement->rowCount() > 0) {
			$resultset = $venStatement->fetch(PDO::FETCH_ASSOC);
			echo json_encode($resultset);
		}
		$venStatement->closeCursor();
	}
?>