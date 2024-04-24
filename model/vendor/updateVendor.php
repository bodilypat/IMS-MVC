<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/db.php');
	
	// Check if the POST query is received
	if(isset($_POST['vendorVendorID'])) {
		
		$vendorID = htmlentities($_POST['vendorID']);
		$vendorFullName = htmlentities($_POST['vendorFullName']);
		$vendorMobile = htmlentities($_POST['vendorMobile']);
		$vendorPhone = htmlentities($_POST['vendorPhone']);
		$vendorEmail = htmlentities($_POST['vendorEmail']);
		$vendorAddress = htmlentities($_POST['vendorAddress']);
		$vendorAddress2 = htmlentities($_POST['vendorAddress2']);
		$vendorCity = htmlentities($_POST['vendorCity']);
		$vendorDistrict = htmlentities($_POST['vendorDistrict']);
		$vendorStatus = htmlentities($_POST['vendorStatus']);
		
		
		if(!empty($vendorID)){
			if(!empty($vendorFullName) && !empty($vendorMobile) && !empty($vendorAddress)) {
				
				if(filter_var($vendorMobile, FILTER_VALIDATE_INT) === 0 || filter_var($vendorMobile, FILTER_VALIDATE_INT)) {
				} else {
					echo '<div class="alert alert-danger">
						   		<button type="button" class="close" data-dismiss="alert">&times;</button>
					       		Please enter a valid mobile number
						 </div>';
					exit();
				}
				
				if(empty($vendorID)){
					echo '<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							Please enter the Vendor ID to update that vendor. You can find the Vendor ID using the Search tab
						</div>';
					exit();
				}

				if(isset($vendorPhone)){
					if(filter_var($vendorPhone2, FILTER_VALIDATE_INT) === 0 || filter_var($vendorPhone2, FILTER_VALIDATE_INT)) {
						
					} else {
						echo '<div class="alert alert-danger">
						         <button type="button" class="close" data-dismiss="alert">&times;</button>
								 Please enter a valid number for phone number.
							  </div>';
						exit();
					}
				}
				
				if(!empty($vendorEmail)) {
					if (filter_var($vendorEmail, FILTER_VALIDATE_EMAIL) === false) {
						echo '<div class="alert alert-danger">
						           <button type="button" class="close" data-dismiss="alert">&times;</button>
								   Please enter a valid email
							  </div>';
						exit();
					}
				}
				/* check database  */
				$qVen = 'SELECT vendorID FROM vendor WHERE vendorID = :vendorID';
				$vendStatement = $dbcon->prepare($qVen);
				$venStatement->execute(['vendorID' => $vendorID]);
				
				if($venStatement->rowCount() > 0) {
					/* update purchase table */
					$editPurch = 'UPDATE purchase SET vendorName = :vendorName WHERE vendorID = :vendorID';
					$updatePurchStatement = $dbcon->prepare($editPurch);
					$updatePurchStatement->execute(['vendorName' => $vendorFullName, 'vendorID' => $vendorID]);
					
					/* update Vendor table */
					$editVen = 'UPDATE vendor SET fullName = :fullName, email = :email, mobile = :mobile, phone = :phone, address = :address, address2 = :address2, city = :city, district = :district, status = :status WHERE vendorID = :vendorID';
					$updateVenStatement = $conn->prepare($editVen);
					$updateVenStatement->execute(['fullName' => $vendorFullName, 'email' => $vendorEmail, 'mobile' => $vendorMobile, 'phone2' => $vendorPhone, 'address' => $vendorAddress, 'address2' => $vendorAddress2, 'city' => $vendorCity, 'district' => $vendorDistrict, 'vendorID' => $vendorID, 'status' => $vendorStatus]);
					
					echo '<div class="alert alert-success">
					           <button type="button" class="close" data-dismiss="alert">&times;</button>
							   Vendor details updated.
						  </div>';
					exit();
				} else {
					// vendorID is not in DB. Therefore, stop the update and quit
					echo '<div class="alert alert-danger">
					           <button type="button" class="close" data-dismiss="alert">&times;</button>
							   Vendor ID does not exist in DB. Therefore, update not possible.
						  </div>';
					exit();
				}
				
			} else {
				// One or more mandatory fields are empty. Therefore, display the error message
				echo '<div class="alert alert-danger">
				          <button type="button" class="close" data-dismiss="alert">&times;</button>
						  Please enter all fields marked with a (*)
					  </div>';
				exit();
			}
		} else {
			// vendorID is not given by user. Hence, can't update
			echo '<div class="alert alert-danger">
			           <button type="button" class="close" data-dismiss="alert">&times;</button>
					   Please enter the Vendor ID to update that vendor. You can find the Vendor ID using the Search tab
				 </div>';
			exit();
		}
	}
?>