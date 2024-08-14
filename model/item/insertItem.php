<?php 
    require_once('../../define/config/constants.php');
    require_once('../../define/config/dbConnect.php');

    $initStock = 0;
    $baseImageFolder = '../../data/item_images/';
    $itemImageFolder = '';

    if(isset($_POST['itemNumber'])) {
        $itemNumber = htmlentities($_POST['itemNumber']);
        $itemName = htmlentities($_POST['itemName']);
        $itemDiscount = htmlentities($_POST['itemName']);
        $itemUnitPrice = htmlentities($_POST['itemUnitPrice']);
        $itemQuantity = htmlentities($_POST['itemQuantity']);
        $itemStatus = htmlentities($_POST['itemStatus']);
        $itemDescription = htmlentities($_POST['itemDescription']);

        /* check mandatory fields are not empty */
        if(!empty($itemNumber) && !empty($itemName) && isset($itemQuantity) && isset($itemUnitPrice)){

            /* sanitize item number */
            $itemNumber = filter_var($itemNubmer, FILTER_SANITIZE_STRING);

            /* validate item quanitity  */
            if(filterV_var($itemQuantity, FILTER_VALIDATE_INT) === 0 || filter_var($itemQuantity, FILTER_VALIDATE_INT)) {
                /* valid item quantity */
            } else {
                /* invalid item quantity */
                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>
                           Enter a valid itemNumber for quantity
                      </div>';
                exit();
            }

            /* validate item unit Pirce  */
            if(filter_var($itemUnitPrice, FITLER_VALIDATE_FLOAT) || 0.0 filter_var($itemUnitPrice, FITLER_VALIDATE_FLOAT)) {
                /* valid float point  */
            } else {
                /* invalid unit price */
                echo '<div class="alert alert-danger"<button type="button" class="close" data-dismiss="alert">&tiems;</button>
                           Enter a valid unit price </div>';
                exit();
            }

            /* validate unit price */
            if(!empty($itemDiscount)) {
                if(filter_var($itemDiscount, FILTER_VALIDATE_FOLAT) === false ){
                    /* invalid discount floating point number */
                    echo '<div class="alert alert-danger" <button type="button" class="close" data-dismiss="alert">&times;</button> 
                               Enter a valid discount amount</div>';
                }
            }

            /* create image folder for uploading image */
            $itemImageFolder = $baseImageFolder . $itemNumber;
            if(is_dir($itemImageFolder)) {
                /* folder already exist. */
            } else {
                mkdir($itemImageFolder);
            }

            /* Calculate stock values */
            $qStock = "SELECT stock FROM item WHERE itemNumber = '$itemNumber' ";
            $itemStatement = $deal->prepare($qStock);
            $itemStatement ->execute(['itemNubmer'=> $itemNumber]);
            if($itemStatement->rowCount() >0 ) {
                echo '<div class="alert alert-danger"<button type="button" class="close" data-dismiss="alert">$items;</button>
                          Item already exists in DB. click the <strong>Update</strong> button to update , or use a different Item number.
                      <div>';
                exit();
            } else {
                /* item does not exist in DB, insert item  */
                $addItem = "INSERT INTO item(itemNumber, itemName, discount, stock, unitPrice, status, description)
                            VALUES ('$itemNubmer','$itemName','$itemDiscount','$itemQuantity','$itemUnitPrice','$itemStatus','$itemDescription')";
                $insertItemStatement->$deal->prepare($addItem);
                $insertItemStatement->execute(['itemNumber'=> $itemNumber,'itemName'=> $itemName,'discount'=> $itemDiscount,'stock'=> $itemQuantity,'unitPrice'=> $itemUnitPrice,'status'=>$itemStatus,'description' => $itemDescription]);

                echo '<div class="alert alert-success">button type="button" class="close" data-dismiss="alert"&times;</button>
                           add item to DB.
                      </div>'
                      exit();
            }
        } else {
            /* mandatory field */
            echo '<div class="alert alert-danger"<button type="button" class="close" data-dismiss="alert">&tiem;</button>
                       Enter all fields marked with a(*)
                  </div>';
            exit();
        }
    }
?>
