 <?php
	     require_once('../../include/config/constants.php');
		 require_once('../../include/config/dbconnect.php');
		 
		 $qVen = 'SELECT MAX(vendorID) FROM vendor';
		 $venStatement = $dbcon->prepare($qVen);
		 $venStatement->execute();
		 $resultset = $venStatement->fetch(PDO::FETCH_ASSOC);
		 
		 echo $resultset['MAX(vendorID)'];
		 $venStatement->closeCursor();
?>
