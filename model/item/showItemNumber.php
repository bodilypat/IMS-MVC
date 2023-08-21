<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');
	
	/* // Check  POST request is received , execute the script */
	if(isset($_POST['textBoxValue'])){
		$output = '';
		$itemNumString = '%' . htmlentities($_POST['textBoxValue']) . '%';
		
		/*  get the item name */
		$qInumber = 'SELECT itemNumber FROM item WHERE itemNumber LIKE ?';
		$itemStatement = $conn->prepare($qInumber);
		$itemStatement->execute([$itemNumString]);
		
		/* results from query, then display them in a list */
		if($itemStatement->rowCount() > 0){
			$output = '<ul class="list-unstyled suggestionsList" id="itemDetailsItemNumberSuggestionsList">';
			while($result = $itemStatement->fetch(PDO::FETCH_ASSOC)){
				$output .= '<li>' . $result['itemNumber'] . '</li>';
			}
			echo '</ul>';
		} else {
			$output = '';
		}
		$itemStatement->closeCursor();
		echo $output;
	}
?>
