<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/dbconnect.php');
	
	// Check if the POST request is received and if so, execute the script
	if(isset($_POST['textBoxValue'])){
		$output = '';
		$saleIDString = '%' . htmlentities($_POST['textBoxValue']) . '%';
		
		// Construct the SQL query to get the saleID
		$qSale = 'SELECT saleID FROM sale WHERE saleID LIKE ?';
		$saleStatement = $dbcon->prepare($qSale);
		$saleStatement->execute([$saleIDString]);
		
		// If we receive any results from the above query, then display them in a list
		if($statetment->rowCount() > 0){
			
			// Given sale ID is available in DB. Hence create the dropdown list
			$output = '<ul class="list-unstyled adviseList" id="saleIDAdviseList">';
			while($result = $statement->fetch(PDO::FETCH_ASSOC)){
				$output .= '<li>' . $result['saleID'] . '</li>';
			}
			echo '</ul>';
		} else {
			$output = '';
		}
		$statement->closeCursor();
		echo $output;
	}
?>
