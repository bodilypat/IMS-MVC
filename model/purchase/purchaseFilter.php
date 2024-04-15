<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/dbconnect.php');
	
	$unitPrice = 0;
	$quantity = 0;
	$totalPrice = 0;
	
	if(isset($_POST['startDate'])){
		$startDate = htmlentities($_POST['startDate']);
		$endDate = htmlentities($_POST['endDate']);
		
		$qPurch = 'SELECT * FROM purchase WHERE purchaseDate BETWEEN :startDate AND :endDate';
		$purchStatement = $dbcon->prepare($pPurch);
		$purchStatement->execute(['startDate' => $startDate, 'endDate' => $endDate]);
		$output = '<table id="purchaseFilteredReportsTable" class="table table-sm table-striped table-bordered table-hover" style="width:100%">
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
		
		/*  Create table from the selected data */
		while($resultset = $purchStatement->fetch(PDO::FETCH_ASSOC)){
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
							'<td>' . $resultset['unitPrice'] . '</td>' .
							'<td>' . $totalPrice . '</td>' .
						'</tr>';
		}
		
		$purchStatement->closeCursor();
		$output .= '</tbody>
					<tfoot>
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
					</tfoot>
				</table>';
		echo $output;
	}
?>



