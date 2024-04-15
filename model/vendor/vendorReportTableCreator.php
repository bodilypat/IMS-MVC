<?php
	require_once('../../include/config/constants.php');
	require_once('../../include/config/dbconnect.php');
	
	$qVen = 'SELECT * FROM vendor';
	$venStatement = $conn->prepare($qVen);
	$venStatement->execute();

	$output = '<table id="vendorReportTable" class="table table-sm table-striped table-bordered table-hover" style="width:100%">
				<thead>
					<tr>
						<th>Vendor ID</th>
						<th>Full Name</th>
						<th>Email</th>
						<th>Mobile</th>
						<th>Phone </th>
						<th>Address</th>
						<th>Address 2</th>
						<th>City</th>
						<th>District</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>';
	
	// Create table rows from the selected data
	while($resultset = $venStatement->fetch(PDO::FETCH_ASSOC)){
		$output .= '<tr>' .
						'<td>' . $resultset['vendorID'] . '</td>' .
						'<td>' . $resultset['fullName'] . '</td>' .
						'<td>' . $resultset['email'] . '</td>' .
						'<td>' . $resultset['mobile'] . '</td>' .
						'<td>' . $resultset['phone'] . '</td>' .
						'<td>' . $resultset['address'] . '</td>' .
						'<td>' . $resultset['address2'] . '</td>' .
						'<td>' . $resultset['city'] . '</td>' .
						'<td>' . $resultset['district'] . '</td>' .
						'<td>' . $resultset['status'] . '</td>' .
					'</tr>';
	}
	
	$venStatement->closeCursor();
	
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