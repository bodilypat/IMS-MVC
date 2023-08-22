<?php
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');
	
	/*  Check POST request is received , execute the script */
	if(isset($_POST['textBoxValue'])){
		$output = '';
		$purString = '%' . htmlentities($_POST['textBoxValue']) . '%';
		
		/*  get the purchase ID */
 		$qPurchID = 'SELECT purchaseID FROM purchase WHERE purchaseID LIKE ?';
		$purchaseStatement = $conn->prepare($qPurchID);
		$purchaseStatement->execute([$purString]);
		
		/* receive any results from  query, then display them in a list */
		if($purchaseStatement->rowCount() > 0){
			
			/*  Given purchase ID is available in DB. create the dropdown list */
			$output = '<ul class="list-unstyled suggestionsList" id="purchaseDetailsPurchaseIDSuggestionsList">';
			while($resultset = $purchaseStatement->fetch(PDO::FETCH_ASSOC)){
				$output .= '<li>' . $resultset['purchaseID'] . '</li>';
			}
			echo '</ul>';
		} else {
			$output = '';
		}
		$purchaseStatement->closeCursor();
		echo $output;
	}
?>
