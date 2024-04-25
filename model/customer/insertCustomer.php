<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/dbconnect.php');
	
	if(isset($_POST['custFullName'])){
		
		$customerFullName = htmlentities($_POST['customerFullName']);
		$custoemrEmail = htmlentities($_POST['customerEmail']);
		$custoemrMobile = htmlentities($_POST['customerMobile']);
		$customerPhone = htmlentities($_POST['customerPhone']);
		$customerAddress = htmlentities($_POST['customerAddress']);
		$customerAddress2 = htmlentities($_POST['customerAddress2']);
		$customerCity = htmlentities($_POST['customerCity']);
		$customerDistrict = htmlentities($_POST['customerDistrict']);
		$customerStatus = htmlentities($_POST['customerStatus']);

		/* Validate  */
		
		if(isset($custoemrFullName) && isset($custoemrMobile) && isset($custoemrAddress)) {

			if(filter_var($customerMobile, FILTER_VALIDATE_INT) === 0 || filter_var($customerMobile, FILTER_VALIDATE_INT)) {
				/*  Valid mobile number */
			} else {
				/*  Mobile is wrong */
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>
						   Please enter a valid phone number
					  </div>';
				exit();
			}
			
			
			if(!empty($customerPhone)){
				if(filter_var($customerPhone, FILTER_VALIDATE_INT) === false) {
				
					echo '<div class="alert alert-danger">
					           <button type="button" class="close" data-dismiss="alert">&times;</button>
							   Please enter a valid mobile number 2
						  </div>';
					exit();
				}
			}
			
			
			if(!empty($custoemrEmail)) {
				if (filter_var($custEmail, FILTER_VALIDATE_EMAIL) === false) {
						echo '<div class="alert alert-danger">
								    <button type="button" class="close" data-dismiss="alert">&times;</button>
									Please enter a valid email
							  </div>';
					exit();
				}
			}
			
			
			if($customerAddress == ''){
			
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter Address 1
					  </div>';
				exit();
			}
			
			
			if($customerFullName == ''){
			
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter Full Name.
					  </div>';
				exit();
			}
			
			/* Start insert process */

			$addCust = 'INSERT INTO customer(fullName, email, mobile, phone2, address, address2, city, district, status) 
			            VALUES(:customerFullName, :customerEmail, :customerMobile, :customerPhone, :customerAddress, :customerAddress2, :customerCity, :customerDistrict, :customerStatus)';
			$custStatement = $dbcon->prepare($addCust);
			$custStatement->execute(['fullName' => $custoemrFullName, 
			                         'email' => $customerEmail, 
									 'mobile' => $customerMobile, 
									 'phone' => $customerPhone, 
									 'address' => $customerAddress, 
									 'address2' => $customerAddress2, 
									 'city' => $customerCity, 
									 'district' => $customerDistrict, 
									 'status' => $customerStatus]);
			echo '<div class="alert alert-success">
			          <button type="button" class="close" data-dismiss="alert">&times;</button>Customer added to database
				  </div>';
		} else {
			/* One or more fields are empty */
			echo '<div class="alert alert-danger">
			           <button type="button" class="close" data-dismiss="alert">&times;</button>
					    Please enter all fields marked with a (*)
				  </div>';
			exit();
		}
	}
?>