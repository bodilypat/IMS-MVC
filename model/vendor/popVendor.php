<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');

	/* Execute the script if the POST request is submitted */
	if(isset($_POST['venID'])){
		
		$vendorID = htmlentities($_POST['venID']);
		
		$qVendor = 'SELECT * FROM vendor WHERE vendorID = :vendorID';
		$getVendorStatement = $conn->prepare($qVendor);
		$getVendorStatement->execute(['vendorID' => $vendorID]);
		
		/* If data is found for the given vendorID, return it as a json object */
		if($getVendorStatement->rowCount() > 0) {
			$result = $vendorStatement->fetch(PDO::FETCH_ASSOC);
			echo json_encode($result);
		}
		$vendorStatement->closeCursor();
	}
?>
