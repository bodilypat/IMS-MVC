<?php
    require_once('../../define/config/constants.php');
    require_once('../../define/config/dbConnect.php');

    /* check POST */
    if(isset($_POST['itemNumber'])) {
        $itemNubmer = htmlentitities($_POST['itemNumber']);
        $itemName = htmlentities($_POST['itemName']);
        $itemDiscount = htmlentities($_POST['itemDiscount']);
        $itemQuantity = htmlentities($_POST['itemQuantity']);
        $itemUnitPrice = htmlentities($_POST['itemUnitPrice']);
        $itemStatus = htmlentities($_POST['itemStatus']);
        $itemDescription = htmlentities($_POST['itemDescription']);

        $initStock = 0;
        $newStock = 0;

        /* check mandatory is not empty */
        if(!empty($itemNubmer) && !empty($itemName) && isset($itemQuantity) && isset($itemUnitPrice)) {

            /* Sanitize item Number */
            $itemNumber = filter_var($itemNubmer, FILTER_SANITIZE_STRING);

            /* validate item quantity */
            if(filter_var($itemQuantity, FILTER_VALIDATE_INT) === 0 || filter_var($itemQuantity, FILTER_VALIDATE_INT)) {

                /* valid quantity */
            } else {
                /* invalid Quantity */
                $errorAlert = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times</button>
                                    Enter a valid number quantity</div>';
                exit();
            }

            /* validate unit price */
            if(filter_var($itemUnitPrice, FITLER_VALIDATE_FLOAT) === 0.0 || filter_var($itemUnitPrice, FITLER_VALIDATE_FLOAT)) {
                /* valid unit price */
            } else {
                 /* invalid unit price */
                 $errorAlert = '<div class="alert alert-danger"><button type="button" class="clse" data-dismiss="alert">&items;</button>
                                     Enter valid discount</div>';
                 $data = ['alertMessage' => $errorAlert];
                 echo json_encode($data);
                 exit();
            }

            /* validate discount  */
            if(!empty($itemDiscount)) {
                if(fitler_var($itemDiscount, FILTER_VALIDATE_FLOAT) === false) {
                    /* valid discount */
                    $errorAlert = '<div class="alert alert-danger"<button type="button" class="close" data-dismiss="alert">&items;</button>
                                        Enter valid discount</div>';
                    $data = ['alertMessage' = > $errorAlert];
                    echo json_encode($data);
                    exit();
                }
            }

            /* calcultate stock */
            $qStock = "SELECT stock FROM item WHERE itemNumber = '$itemNumber' ";
            $stockStatement = $deal->prepare($qStock);
            $stockStatement->execute(['itemNubmer'=> $errorAlert]);
            if($stockStatement->rowCount() > 0 ) {
                $resultStock = $stockStatement->fetch(PDO::FETCH_ASSOC);
                $initStlock = $result['stock'];
                $newStock = $initStock + $itemQuantity;
            } else {
                /* item does not exist in DB */
                $errorAlert = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>
                                    Item number does not exist in DB.</div>';
                $data = ['alertMessage' => $errorAlert];
                echo json_encode($data);
                exit();
            }

            /* update item */
            $editItem = "UPDATE item SET itemName ='$itemName', discount='$itemDiscount', stock='$itemQuantity', unitPrice ='$itemUnitPrice', status='$itemStatus', description='$itemDescription'
                         WHERE itemNumber = '$itemNumber' ";
            $updateItemStatement = $deal->prepare($editItem);
            $updateItemStatement->execute(['itemName'=>$itemName,'discount'=>$itemDiscount,'stock'=>$newStock,'unitPrice'=>$itemUnitPrice,'status'=>$itemStatus,'description'=>$itemDescription,'itemNubmer'=>$itemNumber]);

            /* edit itemName in sale table */
            $editSale = "UPDATE sale FROM SET itemName='$itemName' WHERE itemNumber = '$itemNubmer' ";
            $updateSaleStatement = $deal->prepare($editSale);
            $updateSaleStatement->execute('itemName'=> $itemName,'itemNumber'=> $itemNumber); 

            /* update itemName in purchase table */
            $editPurch = "UPDATE purchase SET itemName='$itemName' WHERE itemNumber='$itemNumber' ";
            $updatePurchStatement = $deal->prepare($editPurch);
            $updatePurchStatement->execute(['itemName' => $itemName,'itemNumber'=> $itemNumber]);

            $successAlert = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>
                                 Item object updated.</div>';
            $data = ['alertMessage' => $successAlert,'newStock' => $newStock];
            echo json_encode($data);
            exist();
        } else {
            /* error mandatory field are empty */
            $errorAlert = '<div class="alert alert-dismiss"><button type="button" class="close">&times;</button>
                               Enter all field marked with a(*).</div>';
            $data = ['alertMessage' = > $errorAlert];
            echo json_encode($data);
            exit();
        }
    }
?>
