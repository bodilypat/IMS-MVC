<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');
	
	/* Check POST received , execute the script */
	if(isset($_POST['textBoxValue'])){
		$output = '';
		$itemNameString = '%' . htmlentities($_POST['textBoxValue']) . '%';
		
		/* get the item name */
		$qIName = 'SELECT itemName FROM item WHERE itemName LIKE ?';
		$itemStatement = $conn->prepare($qIname);
		$itemStatement->execute([$itemNameString]);
		
		/* If  receive any results from the above query, then display them in a list */
		if($itemStatement->rowCount() > 0){
			$output = '<ul class="list-unstyled suggestionsList" id="itemDetailsItemNamesSuggestionsList">';
			while($resultset = $itemStatement->fetch(PDO::FETCH_ASSOC)){
				$output .= '<li>' . $resultset['itemName'] . '</li>';
			}
			echo '</ul>';
		} else {
			$output = '';
		}
		$itemStatement->closeCursor();
		echo $output;
	}
?>
