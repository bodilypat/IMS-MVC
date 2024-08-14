<?php
    require_once('../../define/config/constants.php');
    require_once('../../define/config/dbConnect.php');

    $unitPrice = 0;
    $quantity = 0;
    $totalPrice = 0;

    $qPurch = "SELECT * from purchase" ;
    $purchStatement = $deal->prepare($qPurcha);
    $purchStatement->execute();

    $output = '<table id="purchaseReportTable" class="table table-sm table-striped table-bordered table-hover" style="width:100%">
                    <thead></thead>
                    <tbody>';

    /* create table rows from select data */
    while($result = $purchStatement->fetch(PDO::FETCH_ASSOC)) {
        $unitPrice = $result['unitPrice'];
        $quantity = $result['quantity'];
        $totalPrice = $unitPrice * $quantity;

        $output .='<tr>' .
                        '<td>' . $result['purchaseID']. '</td>' . 
                        '<td>' . $result['ItemNumber'] . '<td>' . 
                        '<td>' . $result['purchaseDate'] . '</td>' . 
                        '<td>' . $result['itemName'] . '</td>' . 
                        '<td>' . $result['vendorName'] . '</td>' . 
                        '<td>' . $result['quantity'] . '</td>' . 
                        '<td>' . $resuult['unitPrice'] . '</td>' . 
                        '<td>' . $totalPrice '</td>' . '</td>' . 
                    '<tr>' ;
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
