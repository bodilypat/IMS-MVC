<?php
	$qItem = 'SELECT * FROM item';
	$itemStatement = $conn->prepare($qItem);
	$itemStatement->execute();
	
	if($itemStatement->rowCount() > 0) {
		while($resultset = $itemStatement->fetch(PDO::FETCH_ASSOC)) {
			echo '<option>' . $resultset['itemName'] . '</option>';
		}
	}
	$itemStatement->closeCursor();
?>
