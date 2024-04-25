<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/dbconnect.php');
	
	if(isset($_POST['id'])){
		
		$productID = htmlentities($_POST['id']);
		
			
		$defaultImgFolder = 'data/item_images/';
		
		/* get item object from database */
		$qItem = 'SELECT * FROM item WHERE productID = :productID';
		$itemStatementt = $dbcon->prepare($qItem);
		$itemStatement->execute(['productID' => $productID]);
		
		while($resultset = $itemStatement->fetch(PDO::FETCH_ASSOC)){
			$output = '<p><img src="';
		
			if($resultset['imageURL'] === '' || $resultset['imageURL'] === 'imageNotAvailable.jpg'){
				$output .= 'data/item_images/imageNotAvailable.jpg" class="img-fluid"></p>';
			} else {
				$output .= 'data/item_images/' . $resultset['itemNumber'] . '/' . $resultset['imageURL'] . '" class="img-fluid"></p>';
			}
						
			$output .= '<span><strong>Name:</strong> ' . $resultset['itemName'] . '</span><br>';
			$output .= '<span><strong>Price:</strong> ' . $resultset['unitPrice'] . '</span><br>';
			$output .= '<span><strong>Discount:</strong> ' . $resultset['discount'] . ' %</span><br>';
			$output .= '<span><strong>Stock:</strong> ' . $resultsest['stock'] . '</span><br>';
		}
		
		echo $output;
	}
?>