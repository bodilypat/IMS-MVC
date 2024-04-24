<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/db.php');
	
	if(isset($_POST['vendorStatus'])){
		
		$venFullName = htmlentities($_POST['venFullName']);
		$venEmail = htmlentities($_POST['venEmail']);
		$venMobile = htmlentities($_POST['venMobile']);
		$venPhone = htmlentities($_POST['venPhone']);
		$venAddress = htmlentities($_POST['venAddress']);
		$venAddress2 = htmlentities($_POST['venAddress2']);
		$venCity = htmlentities($_POST['venCity']);
		$venDistrict = htmlentities($_POST['venDistrict']);
		$venStatus = htmlentities($_POST['venStatus']);
	
		/*  Check Validate */ 
		if(isset($venFullName) && isset($venMobile) && isset($venAddress)) {
			
			if(filter_var($venMobile, FILTER_VALIDATE_INT) === 0 || filter_var($venMobile, FILTER_VALIDATE_INT)) {
				
			} else {				
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid phone number.
					  </div>';
				exit();
			}			
			/*  Check Mandatory */
			if($venMobile == ''){
				
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter mobile phone number.
					  </div>';
				exit();
			}
				
			if(!empty($venPhone)){
				if(filter_var($venPhone, FILTER_VALIDATE_INT) === false) {			
					echo '<div class="alert alert-danger">
					           <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid mobile number 2.
						  </div>';
					exit();
				}
			}						
			if(!empty($venEmail)) {
				if (filter_var($venEmail, FILTER_VALIDATE_EMAIL) === false) {			
					echo '<div class="alert alert-danger">
					           <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid email.
						  </div>';
					exit();
				}
			}
				
			/*  Validate address */
			if($venAddress == ''){				
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter Address.
					  </div>';
				exit();
			}
			
			/* Start the insert process */

			$addVen = 'INSERT INTO vendor(fullName, email, mobile, phone, address, address2, city, district, status) 
			           VALUES(:venFullName, :venEmail, :venMobile, :venPhone, :venAddress, :venAddress2, :venCity, :venDistrict, :venStatus)';
			$venStatement = $dbcon->prepare($addVen);
			$venStatement->execute(['fullName' => $venFullName, 
			                         'email' => $venEmail, 
									 'mobile' => $venMobile, 
									 'phone' => $venPhone, 
									 'address' => $venAddress, 
									 'address2' => $venAddress2, 
									 'city' => $venCity, 
									 'district' => $venDistrict, 
									 'status' => $venStatus]);
			echo '<div class="alert alert-success">
			           <button type="button" class="close" data-dismiss="alert">&times;</button>Vendor added to database
				  </div>';
		} else {
			/*  One or more fields are empty */
			echo '<div class="alert alert-danger">
			           <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter all fields marked with a (*)
				  </div>';
			exit();
		}
	
	}
?>