<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/dbconnect.php');
	
	/* Check POST received , execute the script */
	if(isset($_POST['textBoxValue'])){
		$output = '';
		$itemNameString = '%' . htmlentities($_POST['textBoxValue']) . '%';
		
		/* get the item name */
		$qItem = 'SELECT itemName FROM item WHERE itemName LIKE ?';
		$itemStatement = $dbcon->prepare($qItem);
		$itemStatement->execute([$itemNameString]);
		
		/* If  receive any results from the above query, then display them in a list */
		if($itemStatement->rowCount() > 0){
			$output = '<ul class="list-unstyled adviseList" id="itemNameAdviseList">';
			while($result = $itemStatement->fetch(PDO::FETCH_ASSOC)){
				$output .= '<li>' . $result['itemName'] . '</li>';
			}
			echo '</ul>';
		} else {
			$output = '';
		}
		$itemStatement->closeCursor();
		echo $output;
	}
?>