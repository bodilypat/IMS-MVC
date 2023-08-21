<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');
	
	/* Check POST,execute the script */
	if(isset($_POST['textBoxValue'])){
		$output = '';
		$itemNumString = '%' . htmlentities($_POST['textBoxValue']) . '%';
		
		/* get the item name */
		$query = 'SELECT itemNumber FROM item WHERE itemNumber LIKE ?';
		$statement = $conn->prepare($query);
		$statement->execute([$itemNumString]);
		
		/* display them in a list */
		if($statement->rowCount() > 0){
			$output = '<ul class="list-unstyled suggestionsList" id="purchaseDetailsItemNumberSuggestionsList">';
			while($resultset = $statement->fetch(PDO::FETCH_ASSOC)){
				$output .= '<li>' . $resultset['itemNumber'] . '</li>';
			}
			echo '</ul>';
		} else {
			$output = '';
		}
		$statement->closeCursor();
		echo $output;
	}
?>