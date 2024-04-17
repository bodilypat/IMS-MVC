<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/dbconnect.php');
	
	/* Check  POST , execute the script */
	if(isset($_POST['textBoxValue'])){
		$output = '';
		$itemNumString = '%' . htmlentities($_POST['textBoxValue']) . '%';
		
		/* query to get the item name */
		$qItem= 'SELECT itemNumber FROM item WHERE itemNumber LIKE ?';
		$itemStatement = $dbcon->prepare($qItem);
		$itemStatement->execute([$itemNumString]);
		
		/* receive any results from query, display them in a list */
		if($itemStatement->rowCount() > 0){
			$output = '<ul class="list-unstyled adviseList" id="saleItemNumberAdviseList">';
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