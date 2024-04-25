<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/dbconnect.php');
	
	// Check if the POST request is received and if so, execute the script
	if(isset($_POST['textBoxValue'])){
		$output = '';
		$itemNumString = '%' . htmlentities($_POST['textBoxValue']) . '%';
		
		// Construct the SQL query to get the item name
		$qItem = 'SELECT itemNumber FROM item WHERE itemNumber LIKE ?';
		$itemStatement = $dbcon->prepare($qInumber);
		$itemStatement->execute([$itemNumString]);
		
		// If we receive any results from the above query, then display them in a list
		if($itemStatement->rowCount() > 0){
			$output = '<ul class="list-unstyled adviseList" id="itemNumberAdviseList">';
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