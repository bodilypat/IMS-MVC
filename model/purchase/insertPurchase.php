<?php
    require_once('../../define/config/constants.php');
    require_once('../../define/config/dbConnect.php');

    if(isset($_POST['purchaseItemNumber'])) {
        $purchItemNumber = $('#purchaseItemNumber').val();
        $purchDate = $('#purchaseDate').val();
        $purchItemName = $('#purchaseItemName').val();
        $purchQuantity = $('#purchaseQuantity').val();
        $purchaseUnitPrice = $('#purchaseUnitPrice').val();
        $purchVendorName = $('#purchaseVendorName').val();

        $initStock = 0;
        $newStock = 0;

        /* Check mandatory fields are not empty */
        if(isset($purchItemNumber) && isset($purchDate) && isset($purchItemName) && isset($purchUnitPrice)) {

            /* check itemNumber is empty */
            if($purchItemNumber == '') {
                echo '<div class="alert-danger"><button type="button" class="close" data-dismiss="alert">&tiems;</button>
                           Enter itemNumber.</div>';
                exit();
            }

            /* check itemName is empty */
            if($purchItemName == '') {
                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>
                           Enter item Name.</div>';
                exit();
            }

            /* check Quantity */
            if($purchQuantity == '') {
                echo '<div class="alert alert-danger"<button type="button" close="close" data-dismiss="alert">&times</button>
                           Enter quantity.</div>';
                exit();
            }

            /* check unit price  */
            if($purchUnitPrice == '') {
                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>
                           Enter unit price.</div>';
                exit();
            }

            /* Santize item number */
            $purchItemNumber = filter_var($purchItemNumber, FILTER_SANTIZE_STRING);

            /* validate item quantity  */
            if(filter_var($purchQuantity, FILTER_VALIDATE_INT) === 0 || filter_var($purchQuantity, FILTER_VALIDATE_INT)) {
                /* valid quantity */
            } else {
                /* invalid quantity */
                echo '<div class="alert alert-danger"alert"><button type="button" class="close" data-dismiss="alert">&times;</button> 
                           enter valid  number of quantity.</div>';
                exit();
            }

            /* validate item quantity */
            if(filter_var($purchUnitPrice) === 0 || filter_var($purchUnitPrice, FILTER_VALIDATE_INT)) {
                /* valid quantity */
            } else {
                /* invalid quantity */
                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>
                           Enter number for unit price.</div> ';
                exit();
            }

            /* check itemNumber exist in DB, calculate stock */
            $qStock = "SELECT stock from item WHERE itemNubmer = '$purchItemNumber" ;
            $itemStockStatement = $deal->prepare($qStock);
            $itemStockStatement->execute(['fullName' => $purchItemNumber]);
            if($itemStockStatement->rowCount() > 0) {
                /* get vendorID from refer vendorName */
                $qVen = "SELECT * FROM vendor WHERE fullName = '$purchVendorName";
                $vendorStatement = $deal->preapre($qVen);
                $vendorStatement->execute(['fullName'=> $purchVendorName]);
                $resultven = $vendorStatement->fetch(PDO::FETCH_ASSOC);
                $vendorID = $resultVen['vendorID'];

                /* add purchase record to purchase table in DB */
                $addPurch = "INSERT INTO purchase(itemNumber, purchaseDate, itemName, unitPrice, quantity, vendorName,vendorID)
                             VALUES('$purchItemNumber','$purchdate','$purchItemName','$purchUnitPrice','$purchQuantity','$purchVendorName','$purchVendorID)";
                $insertPurchStatement = $deal->prepare($addPurch);
                $insertPurchStatement->execute(['itemNumber'=> $purchItemNumber,'purchaseDate'=> $purchDate,'itemName'=> $purchItemName,'unitPrice'=> $purchUnitPrice,'quantity'=>$purchQuantity,'vendorName'=> $purchVendorName,'vendorID'=> $vendorID]);

                /* calculate the new stock value */
                $resultItem = $itemStockStatement->fetch(PDO::FETCH_ASSOC);
                $intStock = $resultItem['stock'];
                $newStock = $initStock + $purchQuantity;

                /* Edit the new stock in item table */
                $editStock = "UPDATE item SET stock = $purchQuantity WHEREN itemNumber = '$purchItemNumber' ";
                $updateStockStatement = $deal->preapare($editStock);
                $updateStockStatement->execute(['stock'=> $newStock,' itemNumber'=> $purchItemNumber]);

                echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button> 
                          purchase details added to database and stock value update.</div>';
                exit();
            } else {
                /* does not exist in DB */
                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button> 
                          Item does not exist in DB</div>';
            }
        } else{
            /* check mandatory fields are empty */
            echo '<div class="alert alert-danger"<button type="button" class="close" data-dismiss="alert">&times;</button>
                       Enter all fields marked with a(*)</div>';
            exit();
        }
    }
?>
