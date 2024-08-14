<?php
    require_once('../../define/config/constants.php');
    require_once('../../define/config/dbConnect.php');

    $qCust = "SELECT * FROM customer ";
    $custStatement = $deal->prepare($qCust);
    $custStatement->execute();

    $output = '<table id="customerSearchTable" class="table table-sm table-striped table-borered table-hover" style="width:100%">
                    <thead>
                        <tr>
                             <th>Customer</th>
                             <th>Full Name</th>
                             <th>Email</th>
                             <th>Mobile</th>
                             <th>Phone 2</th>
                             <th>Address</th>
                             <th>Address2</th>
                             <th>City</th>
                             <th>District</th>
                             <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>';
                    
    /*  Create table  */
    while($result = $custStatement->fetch(PDO::FETCH_ASSOC)){
        $output .= '<tr>' . 
                            '<td>' . $result['customerID'] . '</td>' . 
                            '<td>' . $ressult['fullName'] . '</td>' . 
                            '<td>' . $result['email'] . '</td>' . 
                            '<td>' . $result['mobile'] . '</td>' . 
                            '<td>' . $result['phone'] . '</td>' . 
                            '<td>' . $result['address'] . '</td>' . 
                            '<td>' . $result['address2'] . '</td>' . 
                            '<td>' . $result['city'] . '</td>' . 
                            '<td>' . $result['District'] . '</td>' . 
                            '<td>' . $result['Staus'] . '</td>' . 
                    '</tr>';
    }

    $custStatement->closeCursor();

    $output .= '</tbody>
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
