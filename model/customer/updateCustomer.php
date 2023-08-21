<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');
	
	/* Check if the POST query is received */
	if(isset($_POST['customerDetailsCustomerID'])) {
		
		$customerID = htmlentities($_POST['custID']);
		$customerFullName = htmlentities($_POST['custFullName']);
		$customerMobile = htmlentities($_POST['custMobile']);
		$customerPhone2 = htmlentities($_POST['custPhone2']);
		$customerEmail = htmlentities($_POST['custEmail']);
		$customerAddress = htmlentities($_POST['custAddress']);
		$customerAddress2 = htmlentities($_POST['custAddress2']);
		$customerCity = htmlentities($_POST['custCity']);
		$customerDistrict = htmlentities($_POST['custDistrict']);
		$customerStatus = htmlentities($_POST['custStatus']);
		
		/*  Check if mandatory fields are not empty */

		if(isset($customerFullName) && isset($customerMobile) && isset($customerAddress)) {
			
		
			if(filter_var($customerMobile, FILTER_VALIDATE_INT) === 0 || filter_var($customerMobile, FILTER_VALIDATE_INT)) {
				
			} else {
				
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid mobile number</div>';
				exit();
			}
			
			if(empty($custCustomerID)){
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter the CustomerID to update that customer.</div>';
				exit();
			}
			
			if(!empty($custPhone2)){
				if(filter_var($customerPhone2, FILTER_VALIDATE_INT) === 0 || filter_var($customerPhone2, FILTER_VALIDATE_INT)) {
					
				} else {
					
					echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for phone number 2.</div>';
					exit();
				}
			}
			
			if(!empty($customerEmail)) {
				if (filter_var($customerEmail, FILTER_VALIDATE_EMAIL) === false) {
			
					echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid email</div>';
					exit();
				}
			}

			$qCust = 'SELECT customerID FROM customer WHERE customerID = :customerID';
			$custStatement = $conn->prepare($qCust);
			$custStatement->execute(['customerDetailsCustomerID' => $customerID]);
			
			if($custStatement->rowCount() > 0) {
				
				/*  Construct the UPDATE query */
				$updateCust = 'UPDATE customer SET fullName = :fullName, email = :email, mobile = :mobile, phone2 = :phone2, address = :address, address2 = :address2, city = :city, district = :district, status = :status WHERE customerID = :customerID';
				$updateCustStatement = $conn->prepare($updateCust);
				$updateCustStatement->execute(['fullName' => $customerFullName, 'email' => $customerEmail, 'mobile' => $customerMobile, 'phone2' => $customerPhone2, 'address' => $customerAddress, 'address2' => $customerAddress2, 'city' => $customerCity, 'district' => $customerDistrict, 'status' => $customerStatus, 'customerID' => $customerID]);
				
				/*  EDIT customer name in sale table too */
				$editSale = 'UPDATE sale SET customerName = :customerName WHERE customerID = :customerID';
				$editSaleStatement = $conn->prepare($editSale);
				$editSaleStatement->execute(['customerName' => $customerFullName, 'customerID' => $customerID]);
				
				echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Customer details updated.</div>';
				exit();
			} else {
				/* CustomerID is not in DB. Therefore, stop the update and quit */
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>CustomerID does not exist in DB. Therefore, update not possible.</div>';
				exit();
			}
			
		} else {
			/* One or more mandatory fields are empty. Therefore, display the error message */
			echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter all fields marked with a (*)</div>';
			exit();
		}
	}
?>