<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');
	
	/* Check  POST , execute the script */
	if(isset($_POST['textBoxValue'])){
		$output = '';
		$itemNumString = '%' . htmlentities($_POST['textBoxValue']) . '%';
		
		/* query to get the item name */
		$qInum = 'SELECT itemNumber FROM item WHERE itemNumber LIKE ?';
		$itemStatement = $conn->prepare($sql);
		$itemStatement->execute([$itemNumberString]);
		
		/* receive any results from query, display them in a list */
		if($itemStatement->rowCount() > 0){
			$output = '<ul class="list-unstyled suggestionsList" id="saleDetailsItemNumberSuggestionsList">';
			while($resultset = $itemStatement->fetch(PDO::FETCH_ASSOC)){
				$output .= '<li>' . $resultset['itemNumber'] . '</li>';
			}
			echo '</ul>';
		} else {
			$output = '';
		}
		$itemStatement->closeCursor();
		echo $output;
	}
?>