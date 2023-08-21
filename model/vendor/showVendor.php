<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');
	
	/* Check if the POST request is received , execute the script */
	if(isset($_POST['textBoxValue'])){
		$output = '';
		$venIDString = '%' . htmlentities($_POST['textBoxValue']) . '%';
		
		/*  SQL query to get the vendor ID */
		$qVendor = 'SELECT vendorID FROM vendor WHERE vendorID LIKE ?';
		$vendorStatement = $conn->prepare($qVendor);
		$vendorStatement->execute([$venIDString]);
		
		/* If we receive any results from the above query, then display them in a list */
		if($vendorStatement->rowCount() > 0){
			
			/*  vendor ID is available in DB. create dropdown list */
			$output = '<ul class="list-unstyled suggestionsList" id="vendorDetailsVendorIDSuggestionsList">';
			while($resultset = $vendorStatement->fetch(PDO::FETCH_ASSOC)){
				$output .= '<li>' . $resultset['vendorID'] . '</li>';
			}
			echo '</ul>';
		} else {
			$output = '';
		}
		$vendorStatement->closeCursor();
		echo $output;
	}
?>
