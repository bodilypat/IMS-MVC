<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/dbconnect.php');
	
	/* Check if the POST request is received and if so, execute the script */
	if(isset($_POST['textBoxValue'])){
		$output = '';
		$custIDString = '%' . htmlentities($_POST['textBoxValue']) . '%';
		
		/*  Construct the SQL query to get the customer ID */
		$qCust = 'SELECT customerID FROM customer WHERE customerID LIKE ?';
		$custStatement = $dbcon->prepare($qCust);
		$custStatement->execute([$custIDString]);
		
		if($custStatement->rowCount() > 0){
			
			/*  Given customer ID is available in DB. Hence create the dropdown list */
			$output = '<ul class="list-unstyled adviseList" id="customerIDAdviseList">';
			while($resultCust = $custStatement->fetch(PDO::FETCH_ASSOC)){
				$output .= '<li>' . $resultCust['customerID'] . '</li>';
			}
			echo '</ul>';
		} else {
			$output = '';
		}
		$custStatement->closeCursor();
		echo $output;
	}
?>
