<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/dbconnect.php');
	
	/* check post received */
	if(isset($_POST['customerDetailsCustomerID'])) {
		
		$customerID = htmlentities($_POST['customerID']);
		$customerFullName = htmlentities($_POST['customerFullName']);
		$customerMobile = htmlentities($_POST['customerMobile']);
		$customerPhone = htmlentities($_POST['customerPhone']);
		$customerEmail = htmlentities($_POST['customerEmail']);
		$customerAddress = htmlentities($_POST['customerAddress']);
		$customerAddress2 = htmlentities($_POST['customerAddress2']);
		$customerCity = htmlentities($_POST['customerCity']);
		$customerDistrict = htmlentities($_POST['customerDistrict']);
		$customerStatus = htmlentities($_POST['customerStatus']);
		
		/* check madatory fields not empty */
		if(isset($customerFullName) && isset($customerMobile) && isset($customerAddress)) {
			
			/* validate mobile number */
			if(filter_var($customerMobile, FILTER_VALIDATE_INT) === 0 || filter_var($customerMobile, FILTER_VALIDATE_INT)) {
				/* mobile number is valid */
			} else {
				/* mobile number invalid */
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid mobile number</div>';
				exit();
			}
			
			/* check customerID empty , display an error message */
			if(empty($custCustomerID)){
				echo '<div class="alert alert-danger">
				          <button type="button" class="close" data-dismiss="alert">&times;</button>
						  Please enter the CustomerID to update that customer.
					  </div>';
				exit();
			}
			
			/* validate phone number */
			if(!empty($customerPhone)){
				if(filter_var($customerPhone, FILTER_VALIDATE_INT) === 0 || filter_var($customerPhone, FILTER_VALIDATE_INT)) {
					/* phone number is valid */
				} else {
					/* phone number invalie , display an error message*/
					echo '<div class="alert alert-danger">
					           <button type="button" class="close" data-dismiss="alert">&times;</button>
							   Please enter a valid number for phone number
						 </div>';
					exit();
				}
			}
			
			/* validate email is not empty */
			if(!empty($customerEmail)) {
				if (filter_var($customerEmail, FILTER_VALIDATE_EMAIL) === false) {
					/* email is invalid, display an error message */
					echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid email</div>';
					exit();
				}
			}

			/* check customerID in database */
			$qCust = " SELECT customerID FROM customer WHERE customerID = '$customerID'";
			$custStatement = $dbcon->prepare($custQuery);
			$custStatement->execute(['customerID' => $customerID]);
			
			if($custStatement->rowCount() > 0) {
				
				$editCust = " UPDATE customer SET fullName = :customerFullName, 
				                                 email = '$customerEmail', 
												 mobile = '$customerMobile', 
												 phone = '$customerPhone', 
												 address = '$customerAddress', 
												 address2 = '$customerAddress2', 
												 city = '$customerCity', 
												 district = '$customerDistrict', 
												 status = '$customerStatus'
											WHERE customerID = '$customerID'";
				$updateCustStatement = $dbcon->prepare($editCust);
				$updateCustStatement->execute(['fullName' => $customerFullName, 
				                                'email' => $customerEmail, 
												'mobile' => $customerMobile, 
												'phone' => $customerPhone, 
												'address' => $customerAddress, 
												'address2' => $customerAddress2, 
												'city' => $customerCity, 
												'district' => $customerDistrict, 
												'status' => $customerStatus, 
												'customerID' => $customerID]);
				
				/* update custoname in sale table */
				$editSale = " UPDATE sale SET customerName = '$customerName' WHERE customerID = '$customerID'";
				$updateSaleStatement = $conn->prepare($editSale);
				$updateSaleStatement->execute(['customerName' => $customerFullName, 'customerID' => $customerID]);
				
				echo '<div class="alert alert-success">
				          <button type="button" class="close" data-dismiss="alert">&times;</button>
						  Customer details updated.
					 </div>';
				exit();
			} else {
				/* customerID is not exist in database, stop and quit */
				echo '<div class="alert alert-danger">
				          <button type="button" class="close" data-dismiss="alert">&times;</button>
						  CustomerID does not exist in DB. Therefore, update not possible.
					  </div>';
				exit();
			}
			
		} else {
			/* empty fields , display error message */
			echo '<div class="alert alert-danger">
			          <button type="button" class="close" data-dismiss="alert">&times;</button>
					  Please enter all fields marked with a (*)
				  </div>';
			exit();
		}
	}
?>