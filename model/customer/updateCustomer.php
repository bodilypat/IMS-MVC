<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/db.php');
	
	// Check if the POST query is received
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
		
		// Check if mandatory fields are not empty
		if(isset($customerFullName) && isset($customerMobile) && isset($customerAddress)) {
			
			// Validate mobile number
			if(filter_var($customerMobile, FILTER_VALIDATE_INT) === 0 || filter_var($customerMobile, FILTER_VALIDATE_INT)) {
				// Mobile number is valid
			} else {
				// Mobile number is not valid
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid mobile number</div>';
				exit();
			}
			
			// Check if CustomerID field is empty. If so, display an error message
			// We have to specifically tell this to user because the (*) mark is not added to that field
			if(empty($custCustomerID)){
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter the CustomerID to update that customer.</div>';
				exit();
			}
			
			// Validate second phone number only if it's provided by user
			if(!empty($customerPhone)){
				if(filter_var($customerPhone, FILTER_VALIDATE_INT) === 0 || filter_var($customerPhone, FILTER_VALIDATE_INT)) {
					// Phone number 2 is valid
				} else {
					// Phone number 2 is not valid
					echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for phone number 2.</div>';
					exit();
				}
			}
			
			// Validate email only if it's provided by user
			if(!empty($customerEmail)) {
				if (filter_var($customerEmail, FILTER_VALIDATE_EMAIL) === false) {
					// Email is not valid
					echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid email</div>';
					exit();
				}
			}

			// Check if the given CustomerID is in the DB
			$qCust = 'SELECT customerID FROM customer WHERE customerID = :customerID';
			$custStatement = $conn->prepare($custQuery);
			$custStatement->execute(['customerID' => $customerID]);
			
			if($custStatement->rowCount() > 0) {
				
				// CustomerID is available in DB. Therefore, we can go ahead and UPDATE its details
				// Construct the UPDATE query
				$editCust = 'UPDATE customer SET fullName = :customerFullName, email = :customerEmail, mobile = :CustomerMobile, phone = :customerPhone, address = :customerAddress, address2 = :customerAddress2, city = :customerCity, district = :customerDistrict, status = :customerStatus WHERE customerID = :customerID';
				$updateCustStatement = $conn->prepare($editCust);
				$updateCustStatement->execute(['fullName' => $customerFullName, 'email' => $customerEmail, 'mobile' => $customerMobile, 'phone2' => $customerPhone2, 'address' => $customerAddress, 'address2' => $customerAddress2, 'city' => $customerCity, 'district' => $customerDistrict, 'status' => $customerStatus, 'customerID' => $customerID]);
				
				// UPDATE customer name in sale table too
				$editSale = 'UPDATE sale SET customerName = :customerName WHERE customerID = :customerID';
				$updateSaleStatement = $conn->prepare($editSale);
				$updateSaleStatement->execute(['customerName' => $customerFullName, 'customerID' => $customerID]);
				
				echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Customer details updated.</div>';
				exit();
			} else {
				// CustomerID is not in DB. Therefore, stop the update and quit
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>CustomerID does not exist in DB. Therefore, update not possible.</div>';
				exit();
			}
			
		} else {
			// One or more mandatory fields are empty. Therefore, display the error message
			echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter all fields marked with a (*)</div>';
			exit();
		}
	}
?>