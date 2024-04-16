<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/dbconnect.php');
	
	/* Check if the POST request is received , execute the script */
	if(isset($_POST['textBoxValue'])){
		$output = '';
		$venIDString = '%' . htmlentities($_POST['textBoxValue']) . '%';
		
		/*  SQL query to get the vendor ID */
		$qVen = 'SELECT vendorID FROM vendor WHERE vendorID LIKE ?';
		$venStatement = $dbcon->prepare($qVen);
		$venStatement->execute([$venIDString]);
		
		/* If we receive any results from the above query, then display them in a list */
		if($venStatement->rowCount() > 0){
			
			/*  vendor ID is available in DB. create dropdown list */
			$output = '<ul class="list-unstyled adviseList" id="vendorIDAdviseList">';
			while($result = $getVendorStatement->fetch(PDO::FETCH_ASSOC)){
				$output .= '<li>' . $result['vendorID'] . '</li>';
			}
			echo '</ul>';
		} else {
			$output = '';
		}
		$getVendorStatement->closeCursor();
		echo $output;
	}
?>
