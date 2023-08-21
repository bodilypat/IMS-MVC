<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');
	
	if(isset($_POST['custFullName'])){
		
		$fullName = htmlentities($_POST['custFullName']);
		$email = htmlentities($_POST['custEmail']);
		$mobile = htmlentities($_POST['custMobile']);
		$phone2 = htmlentities($_POST['custPhone2']);
		$address = htmlentities($_POST['custAddress']);
		$address2 = htmlentities($_POST['custAddress2']);
		$city = htmlentities($_POST['custCity']);
		$district = htmlentities($_POST['custDistrict']);
		$status = htmlentities($_POST['custStatus']);

		/* Validate  */
		
		if(isset($fullName) && isset($mobile) && isset($address)) {

			if(filter_var($mobile, FILTER_VALIDATE_INT) === 0 || filter_var($mobile, FILTER_VALIDATE_INT)) {
				/*  Valid mobile number */
			} else {
				/*  Mobile is wrong */
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid phone number</div>';
				exit();
			}
			
			
			if(!empty($phone2)){
				if(filter_var($phone2, FILTER_VALIDATE_INT) === false) {
				
					echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid mobile number 2</div>';
					exit();
				}
			}
			
			
			if(!empty($email)) {
				if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
								echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid email</div>';
					exit();
				}
			}
			
			
			if($address == ''){
			
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter Address 1</div>';
				exit();
			}
			
			
			if($fullName == ''){
			
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter Full Name.</div>';
				exit();
			}
			
			/* Start insert process */

			$addCust = 'INSERT INTO customer(fullName, email, mobile, phone2, address, address2, city, district, status) VALUES(:fullName, :email, :mobile, :phone2, :address, :address2, :city, :district, :status)';
			$custStatement = $conn->prepare($addCust);
			$custStatement->execute(['fullName' => $fullName, 'email' => $email, 'mobile' => $mobile, 'phone2' => $phone2, 'address' => $address, 'address2' => $address2, 'city' => $city, 'district' => $district, 'status' => $status]);
			echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Customer added to database</div>';
		} else {
			/* One or more fields are empty */
			echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter all fields marked with a (*)</div>';
			exit();
		}
	}
?>