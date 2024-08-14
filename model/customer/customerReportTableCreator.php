<?php
    require_once('../../define/config/constant.php');
    require_once('../../define/config/dbConnect.php');

    $qCust = "SELECT * FROM customer ";
    $custStatement = $deal->prepare($qCust);
    $custStatement->execute();

    $output = '<table id="saleReportTable" class="table table-sm table-bordered table-hover" style="width: 100%">
                    <thead>
                        <tr>
                             <th>Customer ID</th>
                             <th>Full Name</th>
                             <th>Email</th>
                             <th>Mobile</th>
                             <th>Phone</th>
                             <th>Address</th>
                             <th>Address2</th>
                             <th>City</th>
                             <th>District</th>
                             <th>Status<th>
                        </tr>
                    </thead>
                    <tbody>';

    /* create table rows from the select data */
    while($result = $custStatement->fetch(PDO::FETCH_ASSOC)) {
        $output .= '<tr>' . 
                        '<td>' . $result['customerID']. '</td>' . 
                        '<td>' . $result['fullName'] . '</td>' . 
                        '<td>' . $result['email'] . '</td>' . 
                        '<td>' . $result['mobile'] . '</td>' . 
                        '<td>' . $result['phone'] . '</td>' . 
                        '<td>' . $result['address'] . '</td>' .
                        '<td>' . $result['address2'] . '</td>' . 
                        '<td>' . $result['city'] . '</td>' . 
                        '<td>' . $result['district'] . '</td>' . 
                        '<td>' . $result['status'] . '</td>' . 
                    '</tr>'; 
    }

    $custStatement->closeCursor();

    $output .='</tbody> 
                 <tfoot>
                       <tr>
                            <td>Customer ID</td>
                            <td>Full Name</td>
                            <td>Email</td>
                            <td>Mobile</td>
                            <td>Phone</td>
                            <td>Address</td>
                            <td>Address2</td>
                            <td>City</td>
                            <td>District</td>
                            <td>Status</td>
                       </tr>
                 </tfoot>
                 </table>';
    echo $output;
?>