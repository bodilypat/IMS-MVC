<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');
	
	if(isset($_POST['venID'])){
		
		$vendorID = htmlentities($_POST['venID']);
		
		/*  Check if mandatory fields are not empty */
		if(!empty($vendorID)){
			
			/*  Sanitize vendorID */
			$vendorID = filter_var($vendorID, FILTER_SANITIZE_STRING);

			/*  get VendorID is in the database */
			$qVendor = 'SELECT vendorID FROM vendor WHERE vendorID=:vendorID';
			$getVendorStatement = $conn->prepare($qVendor);
			$getVendorStatement->execute(['vendorID' => $vendorID]);
			
			if($getVendorStatement->rowCount() > 0){
				
				/*  Vendor exists in DB. start the DELETE process */
				$delVendor = 'DELETE FROM vendor WHERE vendorID=:vendorID';
				$delVendorStatement = $conn->prepare($delVendor);
				$delVendorStatement->execute(['vendorID' => $vendorID]);

				echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Vendor deleted.</div>';
				exit();
				
			} else {
				/*  Vendor does not exist, therefore, tell the user that he can't delete that vendor */ 
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Vendor does not exist in DB. Therefore, can\'t delete.</div>';
				exit();
			}
			
		} else {
			/* vendorDI is empty. Therefore, display the error message */
			echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter the Vendor ID</div>';
			exit();
		}
	}
?>
