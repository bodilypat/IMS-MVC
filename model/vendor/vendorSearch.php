<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/db.php');
	
	$qVendor = 'SELECT * FROM vendor';
	$vendorStatement = $conn->prepare($qVendor);
	$vendorStatement->execute();

	$output = '<table id="vendorReportsTable" class="table table-sm table-striped table-bordered table-hover" style="width:100%">
				<thead>
					<tr>
						<th>Vendor ID</th>
						<th>Full Name</th>
						<th>Email</th>
						<th>Mobile</th>
						<th>Phone 2</th>
						<th>Address</th>
						<th>Address 2</th>
						<th>City</th>
						<th>District</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>';
	
	/* Create table from the selected data */
	while($resultset = $vendorStatement->fetch(PDO::FETCH_ASSOC)){
		$output .= '<tr>' .
						'<td>' . $resultset['vendorID'] . '</td>' .
						'<td>' . $resultset['fullName'] . '</td>' .
						'<td>' . $resultset['email'] . '</td>' .
						'<td>' . $resultset['mobile'] . '</td>' .
						'<td>' . $resultset['phone2'] . '</td>' .
						'<td>' . $resultset['address'] . '</td>' .
						'<td>' . $resultset['address2'] . '</td>' .
						'<td>' . $resultset['city'] . '</td>' .
						'<td>' . $resultset['district'] . '</td>' .
						'<td>' . $resultset['status'] . '</td>' .
					'</tr>';
	}
	
	$vendorStatement->closeCursor();
	
	$output .= '</tbody>
					<tfoot>
						<tr>
							<th>Vendor ID</th>
							<th>Full Name</th>
							<th>Email</th>
							<th>Mobile</th>
							<th>Phone 2</th>
							<th>Address</th>
							<th>Address 2</th>
							<th>City</th>
							<th>District</th>
							<th>Status</th>
						</tr>
					</tfoot>
				</table>';
	echo $output;
?>
