<?php
    require_once('../../define/config/constants.php');
    require_once('../../define/config/dbConnect.php');

    if(isset($_POST['purchaseID'])) {

        $purchItemNumber = htmlentities($_POST['purchaseItemNumber']);
        $purchDate = htmlentities($_POST['purchaseDate']);
        $purchItemName = htmlentities($_POST['purchaseItemName']);
        $purchQuantity = htmlentities($_POST['purchaseQuantity']);
        $purchUnitPrice = htmlentities($_POST['purchaseUnitPrice']);
        $purchID = htmlentities($_POST['purchaseID']);
        $purchVendorName = htmlentities($_POST['purchaseVendorName']);

        $oldOrder = 0;
        $newOrder = 0;
        $balanceStock = 0;
        $purchaseItemNumber = 0;

        /* check mandatory */
        if(isset($purchItemNumber) && isset($purchDate) && isset($purchQuantity) && isset($purchUnitPrice)) {

            /* Sanitize item number */
            $purchItemNumber = filter_var($purchItemNumber, FILTER_SANITIZE_STRING);

            /* validate item quantity */
            if(filter_var($purchQuantity, FILTER_VALIDATE_INT) === 0 || filter_var($purchQuantity, FILTER_VALIDATE_INT)) {
                /* valid quantity */
            } else {
                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>
                          Enter valid quantity,</div>';
                exit();
            }

            /* validate item unit price */
            if(filter_var($purchUnitPrice, FILTER_VALIDATE_FLOAT) === 0.0 || filter_var ($purchUnitPrice, FILTER_VALIDATE_FLOAT)) {
                /* valid unit price */
            } else {
                /* invalid unit price */
                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>
                           Enter number for unit price.</div>';
                exit();
            }

            /* check purchaseID is empty */
            if($purchID == '') {
                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>
                           Enter a purchase ID .</div>';
                exit();
            }

            /* check purchase item number */
            if($purchItemNumber == '') {
                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>
                           Enter itemNumber.</div>';
                exit();
            }

            /* check quantity */
            if($purchQuantity == '') {
                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>
                           Enter quantity.</div>';
                exit();
            }

            /* Get quantity, itemNumber */
            $qPurch = "SELECT * FROM purchase WHERE purchaseID = '$purchID' ";
            $purchStatement = $deal->prepare($qPurch);
            $purchStatement->execute(['purchaseID'=> $purchID ]);

            /* Get vendorID */
            $qVen = "SELECT * FROM vendor WHERE fullName = '$purchVendorName' ";
            $vendorStatement = $deal->parepare($qVen);
            $vendorStatement->execute(['fullName' => $purchVendorName]);

            $resultVen = $vendorStatement->fetch(PDO::FETCH_ASSOC);
            $vendorID = $resultVen['vendorID'];

            if($purchStatement->rowCount() > 0) {
                /* purchase details exists in DB */
                $resultPurch = $purchStatement->fetch(PDO::FETCH_ASSOC);
                $oldOrder = $resultPurch['quantity'];
                $purchaseItemNumber = $resultPurch['itemNumber'];

                if($purchaseItemNumber !== $purchaseItemNumber) {
                    $qItem = "SELECT * FROM item WHERE itemNumber= '$itemNumber' ";
                    $itemStatement = $deal->prepare($qItem);
                    $itemStatement->execute(['itemNumber'=> $purchItemNumber]);

                    if($itemStatement->rowCount() < 1) {
                        /* item number does not in DB */
                        echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>
                                   Item Number does not exist in dB.</div>';
                        exit();
                    }

                    /* calculate new stock */
                    $resultItem = $itemStatement->fetch(PDO::FETCH_ASSOC);
                    $balanceStock = $resultItem['stock'];
                    $newOrder = $purchQuantity;
                    $newStock = $balanceStock + $newOrder;

                    /* update new stock */
                    $editStock = "UPDATE item SET stock = '$newStock' WHERE itemNumber = '$purchItemNumber ' ";
                    $updateStockStatement = $deal->prepare($editStock);
                    $updateStockStatement->execute(['stock'=> $newStock, 'itemNumber'=> $purchItemNumber]);

                    /* Get current stock */
                    $qItem = "SELECT * FROM item WHERE itemNumber= '$purchaseItemNumber' ";
                    $currentItemStatement = $deal->prepare($qItem);
                    $currentItemStatement->execute(['itemNumber' => $purchaseItemNumber]);

                    /* calculate new stock */
                    $result = $currentItemStatement->fetch(PDO::FETCH_ASSOC);
                    $currentStock = $result['stock'];
                    $itemStock = $currentStock - $oldOrder;

                    /* Edit Stock */
                    $editItemStock = "UPDATE item SET stock = '$itemStock' WHERE itemNumber ='$purchaseItemNumber' ";
                    $updateItemStatement = $deal->prepare($editItemStock);
                    $updateItemStatement->execute(['stock'=>$itemStock,'itemNumber'=> $purchaseItemNumber]);

                    /* Finally UPDATE purchase */
                    $editPurch = "UPDATE purchase SET itemNumber = '$purchItemNubmer',
                                                      purchaseDate = '$purchDate',
                                                      itemName = '$purchItemName',
                                                      unitPrice = '$purchUnitPrice',
                                                      quantity = '$purchQuantity',
                                                      vendorName = '$purchVendorName',
                                                      vendorID = '$purchVendorID',
                                 WHERE purchaseID = '$purchID' ";
                    $updatePurchStatement = $deal->prepare($editPurch);
                    $updatePurchStatement->execute(['itemNumber'=> $purchItemNumber,
                                                    'purchaseDate'=> $purchItemNumber, 
                                                    'itemName'=> $purchItemName,
                                                    'unitPrice'=> $purchUnitPrice,
                                                    'quantity'=> $purchUnitPrice,
                                                    'vendorName'=> $purchVendorName,
                                                    'vendorID' => $purchVendorID,
                                                    'purchaseID'=> $purchID ]);
                    
                    echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>
                               Purchase details add to DB.</div>';
                    exit();
                } else {
                    /* itemNumber are equal. */
                    /* Get stock from item table */
                    $qStock = "SELECT * FROM item WHERE itemNumber = '$purchItemNumber' ";
                    $stockItemStatement = $deal->prepare($qStock);
                    $stockItemStatement->execute(['itemNumber'=> $purchItemNumber]);

                    if($stockItemStatement->rowCount() > 0) {
                        /* calculate new stock */
                        $resultItem = $stockItemStatement->fetch(PDO::FETCH_ASSOC);
                        $newOrder = $purchQuantity;
                        $balanceStock = $resultItem['stock'];
                        $newStock = $balanceStock + ($newOrder - $oldOrder);

                        /* Edit stock */
                        $editStock = "UPDATE item SET stock = '$newStock ' WHERE itemNumber = '$purchItemNumber '";
                        $updateItemStatement = $deal->prepare($editStock);
                        $updateItemStatement->execute(['stock'=> $newStock,'itemNumber'=> $purchItemNumber]);

                        /* update purchase */
                        $updatePurch = "UPDATE purchase SET purchaseItemNubmer = '$purchItemNumber',
                                                            purchaseDate = '$purchDate',
                                                            unitPrice = '$purchUnitPrice',
                                                            quantity = '$purchQuantity',
                                                            vendorName = '$purchVendorName', 
                                                            vendorID = '$purchVendorID',
                                        WHERE purchaseID = '$purchID' ";
                        $updatePurchStatement = $deal->prepare($updatePurch);
                        $updatePurchStatement->execute(['purchaseItemNumber'=> $purchItemNumber,
                                                         'purchaseDate'=> $purchDate,
                                                         'unitPrice'=> $purchUnitPrice,
                                                         'quantity'=> $purchQuantity,
                                                         'vendorName'=> $purchVendorName,
                                                         'vendorID'=> $purchVendorID,
                                                         'purchaseID'=> $purchID]);
                        
                        echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;
                                  Purchase details updated.</div>';
                        exit();
                    } else {
                        echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;
                                   Item does not exist id DB.</div>';
                        exit();
                    }
                }
            } else {
                /* purchaseID does not exist in purchase table */
                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>&tiems;
                           purchase details does not exist in DB.</div>';
                exit();
            }
        } else {
            /* mandatory fields */
            echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>
                       Enter all fields marked with a(*)</div>';
            exit();
        }
    }
?>
