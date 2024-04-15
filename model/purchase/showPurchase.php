<?php
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/dbconnect.php');
	
	/*  Check POST request is received , execute the script */
	if(isset($_POST['textBoxValue'])){
		$output = '';
		$purString = '%' . htmlentities($_POST['textBoxValue']) . '%';
		
		/*  get the purchase ID */
 		$qPurch = 'SELECT purchaseID FROM purchase WHERE purchaseID LIKE ?';
		$purchStatement = $conn->prepare($qPurch);
		$purchStatement->execute([$purString]);
		
		/* receive any results from  query, then display them in a list */
		if($purchStatement->rowCount() > 0){
			
			/*  Given purchase ID is available in DB. create the dropdown list */
			$output = '<ul class="list-unstyled adviseList" id="purchaseIDAdviseList">';
			while($resultPur = $purchStatement->fetch(PDO::FETCH_ASSOC)){
				$output .= '<li>' . $resultPur['purchaseID'] . '</li>';
			}
			echo '</ul>';
		} else {
			$output = '';
		}
		$purchaseStatement->closeCursor();
		echo $output;
	}
?>
