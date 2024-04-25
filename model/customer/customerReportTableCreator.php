<?php
	require_once('../../define/config/constants.php');
	require_once('../../define/config/dbconnect.php');
	
	$qCust = 'SELECT * FROM customer';
	$custStatement = $dbcon->prepare($qCust);
	$custStatement->execute();

	$output = '<table id="customerReportTable" class="table table-sm table-striped table-bordered table-hover" style="width:100%">
				<thead>
					<tr>
						<th>Customer ID</th>
						<th>Full Name</th>
						<th>Email</th>
						<th>Mobile</th>
						<th>Phone</th>
						<th>Address</th>
						<th>Address 2</th>
						<th>City</th>
						<th>District</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>';
	
	/*  Create customer table from customer object select from DB */
	while($resultset = $custStatement->fetch(PDO::FETCH_ASSOC)){
		$output .= '<tr>' .
						'<td>' . $resultset['customerID'] . '</td>' .
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
	
	$custStatement->closeCursor();
	
	$output .= '</tbody>
					<tfoot>
						<tr>
							<th>Customer ID</th>
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
					</tfoot>
				</table>';
	echo $output;
?>