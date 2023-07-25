<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');
	
	// Check if the POST request is received and if so, execute the script
	if(isset($_POST['textBoxValue'])){
		$output = '';
		$venIDString = '%' . htmlentities($_POST['textBoxValue']) . '%';
		
		// Construct the SQL query to get the vendor ID
		$query = 'SELECT vendorID FROM vendor WHERE vendorID LIKE ?';
		$statement = $conn->prepare($query);
		$statement->execute([$venIDString]);
		
		// If we receive any results from the above query, then display them in a list
		if($statement->rowCount() > 0){
			
			// Given vendor ID is available in DB. Hence create the dropdown list
			$output = '<ul class="list-unstyled suggestionsList" id="vendorDetailsVendorIDSuggestionsList">';
			while($row = $statement->fetch(PDO::FETCH_ASSOC)){
				$output .= '<li>' . $row['vendorID'] . '</li>';
			}
			echo '</ul>';
		} else {
			$output = '';
		}
		$statement->closeCursor();
		echo $output;
	}
?>
    
