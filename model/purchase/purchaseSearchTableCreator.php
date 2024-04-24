<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/dbconnect.php');
	
	$unitPrice = 0;
	$quantity = 0;
	$totalPrice = 0;
	
	
	$qPurch = 'SELECT * FROM purchase';
	$purchStatement = $dbcon->prepare($qPurch);
	$purchStatement->execute();

	$output = '<table id="purchaseSearchTable" class="table table-sm table-striped table-bordered table-hover" style="width:100%">
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
	
	/* Create table rows from the selected data */
	while($resultset = $purchStatement->fetch(PDO::FETCH_ASSOC)){
		$unitPrice = $resultset['unitPrice'];
		$quantity = $resultset['quantity'];
		$totalPrice = $unitPrice * $quantity;
		
		$output .= '<tr>' .
						'<td>' . $resultset['purchaseID'] . '</td>' .
						'<td>' . $resultset['itemNumber'] . '</td>' .
						'<td>' . $resultset['purchaseDate'] . '</td>' .
						'<td>' . $resultset['itemName'] . '</td>' .
						'<td>' . $resultset['unitPrice'] . '</td>' .
						'<td>' . $resultset['quantity'] . '</td>' .
						'<td>' . $resultset['vendorName'] . '</td>' .
						'<td>' . $resultset['vendorID'] . '</td>' .
						'<td>' . $totalPrice . '</td>' .
					'</tr>';
	}
	
	$purchStatement->closeCursor();
	
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
