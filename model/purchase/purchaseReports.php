<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');
	
	$unitPrice = 0;
	$quantity = 0;
	$totalPrice = 0;
	
	$qPurchase = 'SELECT * FROM purchase';
	$purchaseStatement = $conn->prepare($qPurchase);
	$purchaseStatement->execute();

	$output = '<table id="purchaseReportsTable" class="table table-sm table-striped table-bordered table-hover" style="width:100%">
				<thead>
					<tr>
						<th>Purchase ID</th>
						<th>Item Number</th>
						<th>Purchase Date</th>
						<th>Item Name</th>
						<th>Vendor Name</th>
						<th>Vendor ID</th>
						<th>Quantity</th>
						<th>Unit Price</th>
						<th>Total Price</th>
					</tr>
				</thead>
				<tbody>';
	
	/* Create table from the selected data */
	while($resultset = $purchaseStatement->fetch(PDO::FETCH_ASSOC)){
		$unitPrice = $resultset['unitPrice'];
		$quantity = $resultset['quantity'];
		$totalPrice = $unitPrice * $quantity;
		
		$output .= '<tr>' .
						'<td>' . $resultset['purchaseID'] . '</td>' .
						'<td>' . $resultset['itemNumber'] . '</td>' .
						'<td>' . $resultset['purchaseDate'] . '</td>' .
						'<td>' . $resultset['itemName'] . '</td>' .
						'<td>' . $resultset['vendorName'] . '</td>' .
						'<td>' . $resultset['vendorID'] . '</td>' .
						'<td>' . $resultset['quantity'] . '</td>' .
						'<td>' . $ressultset['unitPrice'] . '</td>' .
						'<td>' . $totalPrice . '</td>' .
					'</tr>';
	}
	
	$purchaseStatement->closeCursor();
	
	$output .= '</tbody>
					<tfoot>
						<tr>
							<th>Total</th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
						</tr>
					</tfoot>
				</table>';
	echo $output;
?>


