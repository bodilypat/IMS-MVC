?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/dbconnect.php');
	
	/* Check  POST query is received */
	if(isset($_POST['vendorID'])) {
		
		$vendorID = htmlentities($_POST['vendorID']);
		$vendorFullName = htmlentities($_POST['vendorFullName']);
		$vendorMobile = htmlentities($_POST['vendorMobile']);
		$vendorPhone = htmlentities($_POST['vendorPhone']);
		$vendorEmail = htmlentities($_POST['vendorEmail']);
		$vendorAddress = htmlentities($_POST['vendorAddress']);
		$vendorAddress2 = htmlentities($_POST['vendorAddress2']);
		$vendorCity = htmlentities($_POST['VendorCity']);
		$vendorDistrict = htmlentities($_POST['vendorDistrict']);
		$vendorStatus = htmlentities($_POST['vendorStatus']);
		
			
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
								
				if(isset($vendorPhone)){
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

				$qVen = 'SELECT vendorID FROM vendor WHERE vendorID = :vendorID';
				$venStatement = $dbcon->prepare($qVen);
				$venStatement->execute(['vendorID' => $vendorID]);
				
				if($venStatement->rowCount() > 0) {
					
					/* vendorID is available in DB.,  UPDATE its details */				
					/* EDIT the purchase details vendor name in the purchase table */

					$editPur = 'UPDATE purchase SET vendorName = :vendorName WHERE vendorID = :vendorID';
					$purchStatement = $dbcon->prepare($editPur);
					$purChStatement->execute(['vendorName' => $vendorFullName, 'vendorID' => $vendorID]);
					
					/* UPDATE vendor table */
					$editVen = 'UPDATE vendor SET fullName = :vendorFullName, 
					                              email = :vendorEmail, 
												  mobile = :vendorMobile, 
												  phone = :vendorPhone, 
												  address = :vendorAddress, 
												  address2 = :vendorAddress2, 
												  city = :vendorCity, 
												  district = :vendorDistrict, 
												  status = :vendorStatus 
											WHERE vendorID = :vendorID';
					$venStatement = $conn->prepare($editVen);
					$venStatement->execute(['fullName' => $vendorFullName, 
					                         'email' => $vendorEmail, 
											 'mobile' => $vendorMobile, 
											 'phone2' => $vendorPhone2, 
											 'address' => $vendorAddress, 
											 'address2' => $vendorAddress2, 
											 'city' => $vendorCity, 
											 'district' => $vendorDistrict, 
											 'vendorID' => $vendorID, 
											 'status' => $vendorStatus]);
					
					/* Edit vendor name in purchase table too */
					$editPur = 'UPDATE purchase SET vendorName = :vendorName WHERE vendorID = :vendorID';
					$purchStatement = $dbcon->prepare($editPur);
					$purchStatement->execute(['vendorName' => $vendorFullName, 'vendorID' => $vendorID]);
					
					echo '<div class="alert alert-success">
					           <button type="button" class="close" data-dismiss="alert">&times;</button>Vendor details updated.
					      </div>';
					exit();
				} else {
					/* vendorID is not in DB., stop the update and quit */
					echo '<div class="alert alert-danger">
					           <button type="button" class="close" data-dismiss="alert">&times;</button>Vendor ID does not exist in DB. Therefore, update not possible.
						 </div>';
					exit();
				}
				
			} else {
				/* One or more mandatory fields are empty.display the error message */
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter all fields marked with a (*)
					  </div>';
				exit();
			}
		} else {
			/*  can't update */
			echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter the Vendor ID to update that vendor. You can find the Vendor ID using the Search tab</div>';
			exit();
		}
	}
?>
