<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');
	
	// Check if the POST query is received
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
		
		
		// Check if vendorID is given or not. If not given, the display a message
		if(!empty($vendorID)){
			// Check if mandatory fields are not empty
			if(!empty($vendorFullName) && !empty($vendorMobile) && !empty($vendorAddress)) {
				
				// Validate mobile number
				if(filter_var($vendorMobile, FILTER_VALIDATE_INT) === 0 || filter_var($vendorMobile, FILTER_VALIDATE_INT)) {
					// Mobile number is valid
				} else {
					// Mobile number is not valid
					echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid mobile number</div>';
					exit();
				}
				
				// Check if vendorID field is empty. If so, display an error message
				// We have to specifically tell this to user because the (*) mark is not added to that field
				if(empty($vendorID)){
					echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter the Vendor ID to update that vendor. You can find the Vendor ID using the Search tab</div>';
					exit();
				}
				
				// Validate second phone number only if it's provided by user
				if(isset($vendorPhone2)){
					if(filter_var($vendorPhone2, FILTER_VALIDATE_INT) === 0 || filter_var($vendorPhone2, FILTER_VALIDATE_INT)) {
						// Phone number 2 is valid
					} else {
						// Phone number 2 is not valid
						echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for phone number 2.</div>';
						exit();
					}
				}
				
				// Validate email only if it's provided by user
				if(!empty($vendorEmail)) {
					if (filter_var($vendorEmail, FILTER_VALIDATE_EMAIL) === false) {
						// Email is not valid
						echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid email</div>';
						exit();
					}
				}

				// Check if the given vendorID is in the DB
				$venQuery = 'SELECT vendorID FROM vendor WHERE vendorID = :vendorID';
				$vendStatement = $conn->prepare($venQuery);
				$venStatement->execute(['vendorID' => $vendorID]);
				
				if($venStatement->rowCount() > 0) {
					
					// vendorID is available in DB. Therefore, we can go ahead and UPDATE its details
					
					// First Edit the purchase details vendor name in the purchase table
					$editPurchaseByVenName = 'UPDATE purchase SET vendorName = :vendorName WHERE vendorID = :vendorID';
					$updatePurchaseStatement = $conn->prepare($editPurchaseByVenName);
					$updatePurchaseStatement->execute(['vendorName' => $vendorFullName, 'vendorID' => $vendorID]);
					
					// Construct the UPDATE query
					$updateVendor = 'UPDATE vendor SET fullName = :fullName, email = :email, mobile = :mobile, phone2 = :phone2, address = :address, address2 = :address2, city = :city, district = :district, status = :status WHERE vendorID = :vendorID';
					$updateVendorStatement = $conn->prepare($updateVendor);
					$updateVendorStatement->execute(['fullName' => $vendorFullName, 'email' => $vendorEmail, 'mobile' => $vendorMobile, 'phone2' => $vendorPhone2, 'address' => $vendorAddress, 'address2' => $vendorAddress2, 'city' => $vendorCity, 'district' => $vendorDistrict, 'vendorID' => $vendorID, 'status' => $vendorStatus]);
					
					// Edit vendor name in purchase table too
					$editVenNameInPurchase = 'UPDATE purchase SET vendorName = :vendorName WHERE vendorID = :vendorID';
					$updateVenInPurchaseStatement = $conn->prepare($editVenNameInPurchase);
					$updateVenInPurchaseStatement->execute(['vendorName' => $vendorFullName, 'vendorID' => $vendorID]);
					
					echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Vendor details updated.</div>';
					exit();
				} else {
					// vendorID is not in DB. Therefore, stop the update and quit
					echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Vendor ID does not exist in DB. Therefore, update not possible.</div>';
					exit();
				}
				
			} else {
				// One or more mandatory fields are empty. Therefore, display the error message
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter all fields marked with a (*)</div>';
				exit();
			}
		} else {
			// vendorID is not given by user. Hence, can't update
			echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter the Vendor ID to update that vendor. You can find the Vendor ID using the Search tab</div>';
			exit();
		}
	}
?>
    
