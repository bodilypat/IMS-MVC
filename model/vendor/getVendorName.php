<?php
	$qVendor = 'SELECT * FROM vendor';
	$vendorStatement = $conn->prepare($qVendor);
	$vendorStatement->execute();
	
	if($vendorStatement->rowCount() > 0) {
		while($result = $vendorStatement->fetch(PDO::FETCH_ASSOC)) {
			echo '<option value="' .$resultset['fullName'] . '">' . $resultset['fullName'] . '</option>';
		}
	}
	$vendorStatement->closeCursor();
?>
