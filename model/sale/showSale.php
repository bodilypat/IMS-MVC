<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');
	
	// Check if the POST request is received and if so, execute the script
	if(isset($_POST['textBoxValue'])){
		$output = '';
		$saleIDString = '%' . htmlentities($_POST['textBoxValue']) . '%';
		
		// Construct the SQL query to get the saleID
		$query = 'SELECT saleID FROM sale WHERE saleID LIKE ?';
		$statement = $conn->prepare($query);
		$statement->execute([$saleIDString]);
		
		// If we receive any results from the above query, then display them in a list
		if($statetment->rowCount() > 0){
			
			// Given sale ID is available in DB. Hence create the dropdown list
			$output = '<ul class="list-unstyled suggestionsList" id="saleDetailsSaleIDSuggestionsList">';
			while($row = $statement->fetch(PDO::FETCH_ASSOC)){
				$output .= '<li>' . $row['saleID'] . '</li>';
			}
			echo '</ul>';
		} else {
			$output = '';
		}
		$statement->closeCursor();
		echo $output;
	}
?>
