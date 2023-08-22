<?php
	$qVendor = 'SELECT * FROM vendor';
	$getVendorStatement = $conn->prepare($qVendor);
	$getVendorStatement->execute();
	
	if($getVendorStatement->rowCount() > 0) {
		while($resultset = $vendorStatement->fetch(PDO::FETCH_ASSOC)) {
			echo '<option value="' .$resultset['fullName'] . '">' . $resultset['fullName'] . '</option>';
		}
	}
	$vendorStatement->closeCursor();
?>
