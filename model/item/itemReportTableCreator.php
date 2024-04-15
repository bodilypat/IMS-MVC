<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/dbconnect.php');
	
	$qItem = 'SELECT * FROM item';
	$itemStatement = $dbconn->prepare($qItem);
	$itemStatement->execute();

	$output = '<table id="itemReportTable" class="table table-sm table-striped table-bordered table-hover" style="width:100%">
				<thead>
					<tr>
						<th>Product ID</th>
						<th>Item Number</th>
						<th>Item Name</th>
						<th>Discount %</th>
						<th>Stock</th>
						<th>Unit Price</th>
						<th>Status</th>
						<th>Description</th>
					</tr>
				</thead>
				<tbody>';
	
	// Create table rows from the selected data
	while($resultset = $itemStatement->fetch(PDO::FETCH_ASSOC)){
		$output .= '<tr>' .
						'<td>' . $resultset['productID'] . '</td>' .
						'<td>' . $resultset['itemNumber'] . '</td>' .						
						'<td><a href="#" class="itemDetailsHover" data-toggle="popover" id="' . $resultset['productID'] . '">' . $resultset['itemName'] . '</a></td>' .
						'<td>' . $resultset['discount'] . '</td>' .
						'<td>' . $resultset['stock'] . '</td>' .
						'<td>' . $resultset['unitPrice'] . '</td>' .
						'<td>' . $resultset['status'] . '</td>' .
						'<td>' . $resultset['description'] . '</td>' .
					'</tr>';
	}
	
	$itemStatement->closeCursor();
	
	$output .= '</tbody>
					<tfoot>
						<tr>
							<th>Product ID</th>
							<th>Item Number</th>
							<th>Item Name</th>
							<th>Discount %</th>
							<th>Stock</th>
							<th>Unit Price</th>
							<th>Status</th>
							<th>Description</th>
						</tr>
					</tfoot>
				</table>';
	echo $output;
?>