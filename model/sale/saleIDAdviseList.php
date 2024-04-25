<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/dbconnect.php');
	
	/* Check  POST  execute the script */
	if(isset($_POST['textBoxValue'])){
		$output = '';
		$saleIDString = '%' . htmlentities($_POST['textBoxValue']) . '%';
		
		/* get the saleID */
		$qSale = 'SELECT saleID FROM sale WHERE saleID LIKE ?';
		$saleStatement = $dbcon->prepare($qSale);
		$saleStatement->execute([$saleIDString]);
		
		/* // If we receive any results from the above query, then display them in a list*/
 	if($saleStatetment->rowCount() > 0){
			
			/*  sale ID is available in DB.create the dropdown list
 */			$output = '<ul class="list-unstyled adviseList" id="saleIDAdviseList">';
			while($result = $saleStatement->fetch(PDO::FETCH_ASSOC)){
				$output .= '<li>' . $result['saleID'] . '</li>';
			}
			echo '</ul>';
		} else {
			$output = '';
		}
		$saleStatement->closeCursor();
		echo $output;
	}
?>
