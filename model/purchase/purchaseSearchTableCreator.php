<?php
    require_once('../../define/config/constants.php');
    require_once('../../define/config/dbConnect.php');

    $unitPrice = 0;
    $quantity = 0;
    $totalPrice = 0;

    $qPurch = "SELECT * FROM purchase";
    $purchaseStatement = $deal->prepare($qPurch);
    $purchaseStatement->execute();

    $output = '<table id="purchaseSearchTable" class="table table-sm table-striped table-bordered table-hover" style="width: 100%" >
                    <thead>
                        <tr>
                             <th>Purchase ID</th>
                             <th>Item Name</th>
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

    /* create table rows from the selected data */
    while($result = $purchaseStatement->fetch(PDO::FETCH_ASSOC)) { 
        $unitPrice = $result['unitPrice'];
        $quantity  = $result['quantity'];
        $tatalPrice = $unitPrice * $quantity;

        $output .= '<tr>' . 
                        '<td>' . $result['purchaseID'] . '</td>' . 
                        '<td>' . $result['itemNumber'] . '</td>' .
                        '<td>' . $result['purchaseDate'] . '</td>' . 
                        '<td>' . $result['itemName'] . '</td>' . 
                        '<td>' . $result['unitPrice'] . '</td>' . 
                        '<td>' . $result['quantity'] . '</td>' . 
                        '<td>' . $result['VendorName'] . '</td>' .  
                        '<td>' . $result['vendorID'] . '</td>' . 
                        '<td>' . $totalPrice . '</td>' .
                    '</tr>';
    }
    $purchaseStatement->closeCursor();

    $output .=  '</tbody>
                    <tfoot>
                        <tr>
                             <th>Purchase ID</th>
                             <th>Item Name</th>
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

