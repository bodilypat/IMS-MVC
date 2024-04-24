<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/dbconnect.php');
	
	if(isset($_POST['venID'])){
		
		$venderID = htmlentities($_POST['vendorID']);
		
		/*  Check if mandatory fields are not empty */
		if(!empty($venderID)){
			
			/*  Sanitize vendorID */
			$venderID = filter_var($venID, FILTER_SANITIZE_STRING);

			/*  get VendorID is in the database */
			$qVen = 'SELECT vendorID FROM vendor WHERE vendorID=:venderID';
			$venStatement = $dbcon->prepare($qVen);
			$venStatement->execute(['vendorID' => $venID]);
			
			if($venStatement->rowCount() > 0){
				
				/*  Vendor exists in DB. start the DELETE process */
				$delVen = 'DELETE FROM vendor WHERE vendorID=:venderID';
				$delStatement = $dbcon->prepare($delVen);
				$delStatement->execute(['vendorID' => $vendorID]);

				echo '<div class="alert alert-success">
                                           <button type="button" class="close" data-dismiss="alert">&times;</button>Vendor deleted.
				      </div>';
				exit();
				
			} else {
				/*  Vendor does not exist, therefore, tell the user that he can't delete that vendor */ 
				echo '<div class="alert alert-danger">
                                           <button type="button" class="close" data-dismiss="alert">&times;</button>Vendor does not exist in DB. Therefore, can\'t delete.
                                      </div>';
				exit();
			}
			
		} else {
			/* vendorDI is empty. Therefore, display the error message */
			echo '<div class="alert alert-danger">
                                   <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter the Vendor ID
			      </div>';
			exit();
		}
	}
?>
