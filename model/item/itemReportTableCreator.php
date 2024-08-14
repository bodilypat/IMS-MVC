<?php
    require_once('../../define/config/constants.php');
    require_once('../../define/config/dbConnect.php');

    $qItem = "SELECT * FROM item ";
    $itemStatement = $deal->prepare($qItem);
    $itemStatement->execute();

    $output = '<table id="itemReportTable" class="table table-sm table-striped table-bordered table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Item Number</th>
                            <th>Item Name</th>
                            <th>Discount</th>
                            <th>Stock</th>
                            <th>Unit Price</th>
                            <th>Status</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                <tbody>';
    
    /* create report table */

    while($result = $itemStatement->fetch(PDO::FETCH_ASSOC)) {
        $output .='<tr>' . 
                        '<td>' . $result['productID'] . '</td>' . 
                        '<td>' . $result['itemNumber'] . '</td>' .  
                        '<td><a href="#" class="itemHover" data-toggle="popover" id="' . $result['productID'] . '">' . $result['itemName'] . '</a></td>' . 
                        '<td>' . $result['discount'] . '</td>' . 
                        '<td>' . $result['stock'] . '</td>' . 
                        '<td>' . $result['unitPrice'] . '</td>' . 
                        '<td>' . $result['status'] . '</td>' . 
                        '<td>' . $result['descriipt'] . '</td>' . 
                  '</tr>';
    }

    $itemStatement->closeCursor();

    $output .= '</tbody>
                    <tfoot>
                        <tr>
                            <th>Product ID</th>
                            <th>Item Number</th>
                            <th>Item Name</th>
                            <th>Discount</th>
                            <th>Stock</th>
                            <th>Unit Price</th>
                            <th>Status</th>
                            <th>Description</th>
                        </tr>
                    </tfoot>
                </table>';
    echo $output;
?>