<?php
	$queryItem = 'SELECT itemName FROM item';
	$itemStatement = $conn->prepare($queryItem);
	$itemStatement->execute();
	
	if($itemStatement->rowCount() > 0) {
		while($row = $itemStatement->fetch(PDO::FETCH_ASSOC)) {
			echo '<option>' . $row['itemName'] . '</option>';
		}
	}
	$itemStatement->closeCursor();
?>

