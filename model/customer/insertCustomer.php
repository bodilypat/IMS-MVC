<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/dbconnect.php');
	
	if(isset($_POST['custFullName'])){
		
		$custFullName = htmlentities($_POST['custFullName']);
		$custEmail = htmlentities($_POST['custEmail']);
		$custMobile = htmlentities($_POST['custMobile']);
		$custPhone = htmlentities($_POST['custPhone']);
		$custAddress = htmlentities($_POST['custAddress']);
		$custAddress2 = htmlentities($_POST['custAddress2']);
		$custCity = htmlentities($_POST['custCity']);
		$custDistrict = htmlentities($_POST['custDistrict']);
		$custStatus = htmlentities($_POST['custStatus']);

		/* Validate  */
		
		if(isset($custFullName) && isset($custMobile) && isset($custAddress)) {

			if(filter_var($custMobile, FILTER_VALIDATE_INT) === 0 || filter_var($custMobile, FILTER_VALIDATE_INT)) {
				/*  Valid mobile number */
			} else {
				/*  Mobile is wrong */
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid phone number
					  </div>';
				exit();
			}
			
			
			if(!empty($custPhone)){
				if(filter_var($custPhone, FILTER_VALIDATE_INT) === false) {
				
					echo '<div class="alert alert-danger">
					           <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid mobile number 2
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
			
			
			if($custAddress == ''){
			
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter Address 1
					  </div>';
				exit();
			}
			
			
			if($custFullName == ''){
			
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter Full Name.
					  </div>';
				exit();
			}
			
			/* Start insert process */

			$addCust = 'INSERT INTO customer(fullName, email, mobile, phone2, address, address2, city, district, status) 
			            VALUES(:custFullName, :custEmail, :custMobile, :custPhone, :custAddress, :custAddress2, :custCity, :custDistrict, :custStatus)';
			$custStatement = $dbcon->prepare($addCust);
			$custStatement->execute(['fullName' => $custFullName, 
			                         'email' => $custEmail, 
									 'mobile' => $custMobile, 
									 'phone' => $custPhone, 
									 'address' => $custAddress, 
									 'address2' => $custAddress2, 
									 'city' => $custCity, 
									 'district' => $custDistrict, 
									 'status' => $custStatus]);
			echo '<div class="alert alert-success">
			          <button type="button" class="close" data-dismiss="alert">&times;</button>Customer added to database
				  </div>';
		} else {
			/* One or more fields are empty */
			echo '<div class="alert alert-danger">
			           <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter all fields marked with a (*)
				  </div>';
			exit();
		}
	}
?>