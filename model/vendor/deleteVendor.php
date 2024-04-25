<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/dbconnect.php');
	
	if(isset($_POST['vendorID'])){
		
		$vendorID = htmlentities($_POST['vendorID']);
		/* check madatory fields */
		if(!empty($vendorID)){
			
			/* Sanitize VendorID */
			$vendorID = filter_var($vendorID, FILTER_SANITIZE_STRING);

			/* get vendor object from DB */
			$qVen = "SELECT vendorID FROM vendor WHERE vendorID='$vendorID'";
			$venStatement = $dbcon->prepare($qVen);
			$venStatement->execute(['vendorID' => $vendorID]);
			
			if($venStatement->rowCount() > 0){
				
				/* Vendor exists in database, start delete process */
				$delVen = "DELETE FROM vendor WHERE vendorID='$vendorID'";
				$delVenStatement = $dbcon->prepare($delVen);
				$delVenStatement->execute(['vendorID' => $vendorID]);

				echo '<div class="alert alert-success">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>
					       Vendor deleted.
					 </div>';
				exit();
				
			} else {
				
				/* vendor does not exist */
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>
						   Vendor does not exist in DB. Therefore, can\'t delete.
					  </div>';
				exit();
			}
			
		} else {
			/* vendorID empty */
			echo '<div class="alert alert-danger">
			           <button type="button" class="close" data-dismiss="alert">&times;</button>
					   Please enter the Vendor ID
				  </div>';
			exit();
		}
	}
?>