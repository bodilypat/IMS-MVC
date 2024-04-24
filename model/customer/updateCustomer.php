<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/dbconnect.php');
	
	/* Check if the POST query is received */
	if(isset($_POST['customerDetailsCustomerID'])) {
		
		$custID = htmlentities($_POST['custID']);
		$custFullName = htmlentities($_POST['custFullName']);
		$custMobile = htmlentities($_POST['custMobile']);
		$custPhone = htmlentities($_POST['custPhone']);
		$custEmail = htmlentities($_POST['custEmail']);
		$custAddress = htmlentities($_POST['custAddress']);
		$custAddress2 = htmlentities($_POST['custAddress2']);
		$custCity = htmlentities($_POST['custCity']);
		$custDistrict = htmlentities($_POST['custDistrict']);
		$custStatus = htmlentities($_POST['custStatus']);
		
		/*  Check if mandatory fields are not empty */

		if(isset($custFullName) && isset($custMobile) && isset($custAddress)) {
			
		
			if(filter_var($custMobile, FILTER_VALIDATE_INT) === 0 || filter_var($custMobile, FILTER_VALIDATE_INT)) {
				
			} else {
				
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid mobile number
					  </div>';
				exit();
			}
			
			if(empty($custID)){
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter the CustomerID to update that customer.
				      </div>';
				exit();
			}
			
			if(!empty($custPhone)){
				if(filter_var($custPhone, FILTER_VALIDATE_INT) === 0 || filter_var($custPhone, FILTER_VALIDATE_INT)) {
					
				} else {
					
					echo '<div class="alert alert-danger">
					           <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for phone number 2.
						  </div>';
					exit();
				}
			}
			
			if(!empty($custEmail)) {
				if (filter_var($custEmail, FILTER_VALIDATE_EMAIL) === false) {
			
					echo '<div class="alert alert-danger">
					           <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid email
						  </div>';
					exit();
				}
			}

			$qCust = 'SELECT customerID FROM customer WHERE customerID = :customerID';
			$custStatement = $dbcon->prepare($qCust);
			$custStatement->execute(['customerID' => $custID]);
			
			if($custStatement->rowCount() > 0) {
				
				/*  Construct the UPDATE query */
				$editCust = 'UPDATE customer SET fullName = :fullName, 
				                                 email = :email, 
												 mobile = :mobile, 
												 phone2 = :phone2, 
												 address = :address, 
												 address2 = :address2, 
												 city = :city, 
												 district = :district, 
												 status = :status 
											WHERE customerID = :custID';
				$custStatement = $dbcon->prepare($editCust);
				$custStatement->execute(['fullName' => $custFullName, 
				                          'email' => $custEmail, 
										  'mobile' => $custMobile, 
										  'phone2' => $custPhone2, 
										  'address' => $custAddress, 
										  'address2' => $custAddress2, 
										  'city' => $custCity, 
										  'district' => $custDistrict, 
										  'status' => $custStatus, 
										  'customerID' => $custID]);
				
				/*  EDIT customer name in sale table too */
				$editSale = 'UPDATE sale SET customerName = :custName WHERE customerID = :custID';
				$saleStatement = $dbcon->prepare($editSale);
				$saleStatement->execute(['customerName' => $custFullName, 'customerID' => $custID]);
				
				echo '<div class="alert alert-success">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>Customer details updated.
					  </div>';
				exit();
			} else {
				/* CustomerID is not in DB. Therefore, stop the update and quit */
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>CustomerID does not exist in DB. Therefore, update not possible.
					  </div>';
				exit();
			}
			
		} else {
			/* One or more mandatory fields are empty. Therefore, display the error message */
			echo '<div class="alert alert-danger">
			           <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter all fields marked with a (*)
				  </div>';
			exit();
		}
	}
?>
