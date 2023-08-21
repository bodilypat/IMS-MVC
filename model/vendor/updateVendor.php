<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');
	
	/* Check  POST query is received */
	if(isset($_POST['vendorVendorID'])) {
		
		$vendorID = htmlentities($_POST['venID']);
		$vendorFullName = htmlentities($_POST['venFullName']);
		$vendorMobile = htmlentities($_POST['venMobile']);
		$vendorPhone2 = htmlentities($_POST['venPhone2']);
		$vendorEmail = htmlentities($_POST['venEmail']);
		$vendorAddress = htmlentities($_POST['venAddress']);
		$vendorAddress2 = htmlentities($_POST['venAddress2']);
		$vendorCity = htmlentities($_POST['venVendorCity']);
		$vendorDistrict = htmlentities($_POST['venDistrict']);
		$vendorStatus = htmlentities($_POST['venStatus']);
		
			
		if(!empty($vendorID)){
		/* 	 Check if mandatory fields are not empty */
			if(!empty($vendorFullName) && !empty($vendorMobile) && !empty($vendorAddress)) {
				
				
				if(filter_var($vendorMobile, FILTER_VALIDATE_INT) === 0 || filter_var($vendorMobile, FILTER_VALIDATE_INT)) {
					
				} else {
					
					echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid mobile number</div>';
					exit();
				}
								
				if(empty($vendorID)){
					echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter the Vendor ID to update that vendor. You can find the Vendor ID using the Search tab</div>';
					exit();
				}
								
				if(isset($vendorPhone2)){
					if(filter_var($vendorPhone2, FILTER_VALIDATE_INT) === 0 || filter_var($vendorPhone2, FILTER_VALIDATE_INT)) {
					} else {
						echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for phone number 2.</div>';
						exit();
					}
				}
				
				if(!empty($vendorEmail)) {
					if (filter_var($vendorEmail, FILTER_VALIDATE_EMAIL) === false) {
				
						echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid email</div>';
						exit();
					}
				}

				/*  Check  vendorID is in the DB */

				$qVendor = 'SELECT vendorID FROM vendor WHERE vendorID = :vendorID';
				$vendorStatement = $conn->prepare($qVendor);
				$vendorStatement->execute(['vendorID' => $vendorID]);
				
				if($vendorStatement->rowCount() > 0) {
					
					/* vendorID is available in DB.,  UPDATE its details */				
					/* EDIT the purchase details vendor name in the purchase table */

					$editVname = 'UPDATE purchase SET vendorName = :vendorName WHERE vendorID = :vendorID';
					$updatePurchaseStatement = $conn->prepare($editVname);
					$updatePurchaseStatement->execute(['vendorName' => $vendorFullName, 'vendorID' => $vendorID]);
					
					/* UPDATE vendor table */
					$updateVendor = 'UPDATE vendor SET fullName = :fullName, email = :email, mobile = :mobile, phone2 = :phone2, address = :address, address2 = :address2, city = :city, district = :district, status = :status WHERE vendorID = :vendorID';
					$updateVendorStatement = $conn->prepare($updateVendor);
					$updateVendorStatement->execute(['fullName' => $vendorFullName, 'email' => $vendorEmail, 'mobile' => $vendorMobile, 'phone2' => $vendorPhone2, 'address' => $vendorAddress, 'address2' => $vendorAddress2, 'city' => $vendorCity, 'district' => $vendorDistrict, 'vendorID' => $vendorID, 'status' => $vendorStatus]);
					
					/* Edit vendor name in purchase table too */
					$editVname = 'UPDATE purchase SET vendorName = :vendorName WHERE vendorID = :vendorID';
					$updatePurchaseStatement = $conn->prepare($editVname);
					$updatePurchaseStatement->execute(['vendorName' => $vendorFullName, 'vendorID' => $vendorID]);
					
					echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Vendor details updated.</div>';
					exit();
				} else {
					/* vendorID is not in DB., stop the update and quit */
					echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Vendor ID does not exist in DB. Therefore, update not possible.</div>';
					exit();
				}
				
			} else {
				/* One or more mandatory fields are empty.display the error message */
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter all fields marked with a (*)</div>';
				exit();
			}
		} else {
			/*  can't update */
			echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter the Vendor ID to update that vendor. You can find the Vendor ID using the Search tab</div>';
			exit();
		}
	}
?>
