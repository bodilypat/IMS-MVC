<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/dbconnect.php');
	
	/* Check POST,execute the script */
	if(isset($_POST['textBoxValue'])){
		$output = '';
		$itemNumString = '%' . htmlentities($_POST['textBoxValue']) . '%';
		
		/* get the item name */
		$qItem = 'SELECT itemNumber FROM item WHERE itemNumber LIKE ?';
		$itemStatement = $conn->prepare($query);
		$itemStatement->execute([$itemNumString]);
		
		/* display them in a list */
		if($itemStatement->rowCount() > 0){
			$output = '<ul class="list-unstyled AdviseList" id="purchaseItemNumberAdviseList">';
			while($result = $statement->fetch(PDO::FETCH_ASSOC)){
				$output .= '<li>' . $result['itemNumber'] . '</li>';
			}
			echo '</ul>';
		} else {
			$output = '';
		}
		$statement->closeCursor();
		echo $output;
	}
?>
