<?php
	$venQuery = 'SELECT * FROM vendor';
	$venStatement = $conn->prepare($venQuery);
	$venStatement->execute();
	
	if($venStatement->rowCount() > 0) {
		while($row = $venStatement->fetch(PDO::FETCH_ASSOC)) {
			echo '<option value="' .$row['fullName'] . '">' . $row['fullName'] . '</option>';
		}
	}
	$venStatement->closeCursor();
?>

