<?php
	$qIName = 'SELECT itemName FROM item';
	$itemStatement = $conn->prepare($qIName);
	$itemStatement->execute();
	
	if($itemStatement->rowCount() > 0) {
		while($resultset = $itemStatement->fetch(PDO::FETCH_ASSOC)) {
			echo '<option>' . $resultset['itemName'] . '</option>';
		}
	}
	$itemStatement->closeCursor();
?>
