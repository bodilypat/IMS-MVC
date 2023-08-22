<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');
	
	/* Check if the POST request is received , execute the script */
	if(isset($_POST['textBoxValue'])){
		$output = '';
		$venIDString = '%' . htmlentities($_POST['textBoxValue']) . '%';
		
		/*  SQL query to get the vendor ID */
		$qVendor = 'SELECT vendorID FROM vendor WHERE vendorID LIKE ?';
		$getVendorStatement = $conn->prepare($qVendor);
		$getVendorStatement->execute([$venIDString]);
		
		/* If we receive any results from the above query, then display them in a list */
		if($getVendorStatement->rowCount() > 0){
			
			/*  vendor ID is available in DB. create dropdown list */
			$output = '<ul class="list-unstyled suggestionsList" id="vendorDetailsVendorIDSuggestionsList">';
			while($resultset = $getVendorStatement->fetch(PDO::FETCH_ASSOC)){
				$output .= '<li>' . $resultset['vendorID'] . '</li>';
			}
			echo '</ul>';
		} else {
			$output = '';
		}
		$getVendorStatement->closeCursor();
		echo $output;
	}
?>
