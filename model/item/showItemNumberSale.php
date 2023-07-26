<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');
	
	// Check if the POST request is received and if so, execute the script
	if(isset($_POST['textBoxValue'])){
		$output = '';
		$itemNumString = '%' . htmlentities($_POST['textBoxValue']) . '%';
		
		// Construct the SQL query to get the item name
		$query = 'SELECT itemNumber FROM item WHERE itemNumber LIKE ?';
		$statement = $conn->prepare($sql);
		$statement->execute([$itemNumberString]);
		
		// If we receive any results from the above query, then display them in a list
		if($statement->rowCount() > 0){
			$output = '<ul class="list-unstyled suggestionsList" id="saleDetailsItemNumberSuggestionsList">';
			while($row = $statement->fetch(PDO::FETCH_ASSOC)){
				$output .= '<li>' . $row['itemNumber'] . '</li>';
			}
			echo '</ul>';
		} else {
			$output = '';
		}
		$statement->closeCursor();
		echo $output;
	}
?>
