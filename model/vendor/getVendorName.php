<?php
	$qVen = 'SELECT * FROM vendor';
	$venStatement = $dbcon->prepare($qVen);
	$venStatement->execute();
	
	if($venStatement->rowCount() > 0) {
		while($resultset = $vendorStatement->fetch(PDO::FETCH_ASSOC)) {
			echo '<option value="' .$resultset['fullName'] . '">' . $resultset['fullName'] . '</option>';
		}
	}
	$venStatement->closeCursor();
?>
