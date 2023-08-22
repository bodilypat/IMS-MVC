t<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');
	
	if(isset($_POST['vendorStatus'])){
		
		$fullName = htmlentities($_POST['venFullName']);
		$email = htmlentities($_POST['venEmail']);
		$mobile = htmlentities($_POST['venMobile']);
		$phone2 = htmlentities($_POST['venPhone2']);
		$address = htmlentities($_POST['venAddress']);
		$address2 = htmlentities($_POST['venAddress2']);
		$city = htmlentities($_POST['venCity']);
		$district = htmlentities($_POST['venDistrict']);
		$status = htmlentities($_POST['venStatus']);
	
		/*  Check Validate */ 
		if(isset($fullName) && isset($mobile) && isset($address)) {
			
			if(filter_var($mobile, FILTER_VALIDATE_INT) === 0 || filter_var($mobile, FILTER_VALIDATE_INT)) {
				
			} else {				
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid phone number.</div>';
				exit();
			}			
			/*  Check Mandatory */
			if($mobile == ''){
				
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter mobile phone number.</div>';
				exit();
			}
				
			if(!empty($phone2)){
				if(filter_var($phone2, FILTER_VALIDATE_INT) === false) {			
					echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid mobile number 2.</div>';
					exit();
				}
			}						
			if(!empty($email)) {
				if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {			
					echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid email.</div>';
					exit();
				}
			}
				
			/*  Validate address */
			if($address == ''){				
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter Address.</div>';
				exit();
			}
			
			/* Start the insert process */

			$addVendor = 'INSERT INTO vendor(fullName, email, mobile, phone2, address, address2, city, district, status) VALUES(:fullName, :email, :mobile, :phone2, :address, :address2, :city, :district, :status)';
			$vendorStatement = $conn->prepare($addVendor);
			$vendorStatement->execute(['fullName' => $fullName, 'email' => $email, 'mobile' => $mobile, 'phone2' => $phone2, 'address' => $address, 'address2' => $address2, 'city' => $city, 'district' => $district, 'status' => $status]);
			echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Vendor added to database</div>';
		} else {
			/*  One or more fields are empty */
			echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter all fields marked with a (*)</div>';
			exit();
		}
	
	}
?>
