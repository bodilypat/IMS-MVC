 <?php
	         require_once('../../define/config/constants.php');
		 require_once('../../define/config/dbconnect.php');
		 
		 $qVen = 'SELECT MAX(vendorID) FROM vendor';
		 $venStatement = $dbcon->prepare($qVen);
		 $venStatement->execute();
		 $result = $venStatement->fetch(PDO::FETCH_ASSOC);
		 
		 echo $result['MAX(vendorID)'];
		 $venStatement->closeCursor();
?>
