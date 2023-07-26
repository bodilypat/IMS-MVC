<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');
	
	$unitPrice = 0;
	$quantity = 0;
	$totalPrice = 0;
	
	$queryPurchase = 'SELECT * FROM purchase';
	$purchaseStatement = $conn->prepare($queryPurchase);
	$purchaseStatement->execute();

	$output = '<table id="purchaseDetailsTable" class="table table-sm table-striped table-bordered table-hover" style="width:100%">
				<thead>
					<tr>
						<th>Purchase ID</th>
						<th>Item Number</th>
						<th>Purchase Date</th>
						<th>Item Name</th>
						<th>Unit Price</th>
						<th>Quantity</th>
						<th>Vendor Name</th>
						<th>Vendor ID</th>
						<th>Total Price</th>
					</tr>
				</thead>
				<tbody>';
	
	// Create table rows from the selected data
	while($row = $purchaseStatement->fetch(PDO::FETCH_ASSOC)){
		$unitPrice = $row['unitPrice'];
		$quantity = $row['quantity'];
		$totalPrice = $unitPrice * $qty;
		
		$output .= '<tr>' .
						'<td>' . $row['purchaseID'] . '</td>' .
						'<td>' . $row['itemNumber'] . '</td>' .
						'<td>' . $row['purchaseDate'] . '</td>' .
						'<td>' . $row['itemName'] . '</td>' .
						'<td>' . $row['unitPrice'] . '</td>' .
						'<td>' . $row['quantity'] . '</td>' .
						'<td>' . $row['vendorName'] . '</td>' .
						'<td>' . $row['vendorID'] . '</td>' .
						'<td>' . $totalPrice . '</td>' .
					'</tr>';
	}
	
	$purchaseStatement->closeCursor();
	
	$output .= '</tbody>
					<tfoot>
						<tr>
							<th>Purchase ID</th>
							<th>Item Number</th>
							<th>Purchase Date</th>
							<th>Item Name</th>
							<th>Unit Price</th>
							<th>Quantity</th>
							<th>Vendor Name</th>
							<th>Vendor ID</th>
							<th>Total Price</th>
						</tr>
					</tfoot>
				</table>';
	echo $output;
?>

