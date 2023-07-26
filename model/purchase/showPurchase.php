<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');
	
	// Check if the POST request is received and if so, execute the script
	if(isset($_POST['textBoxValue'])){
		$output = '';
		$purString = '%' . htmlentities($_POST['textBoxValue']) . '%';
		
		// Construct the SQL query to get the purchase ID
		$query = 'SELECT purchaseID FROM purchase WHERE purchaseID LIKE ?';
		$statement = $conn->prepare($query);
		$statement->execute([$purString]);
		
		// If we receive any results from the above query, then display them in a list
		if($statement->rowCount() > 0){
			
			// Given purchase ID is available in DB. Hence create the dropdown list
			$output = '<ul class="list-unstyled suggestionsList" id="purchaseDetailsPurchaseIDSuggestionsList">';
			while($row = $statement->fetch(PDO::FETCH_ASSOC)){
				$output .= '<li>' . $row['purchaseID'] . '</li>';
			}
			echo '</ul>';
		} else {
			$output = '';
		}
		$statement->closeCursor();
		echo $output;
	}
?>
