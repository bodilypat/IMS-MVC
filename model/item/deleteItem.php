<?php
    require_once('../../define/config/constant.php');
    require_once('../../define/config/dbConnect.php');

    $itemNumber = htmlentities($_POST['itemNumber']);

    if(isset($_POST['itemNumber'])) {

        /* check mandatory fields */
        if(!empty($itemNumber)) {

            /* Sanitize item number */
            $itemNumber = filter_var($itemNubmer, FILTER_SANITIZE_STRING);

            /* check itemNumber exist in DB */
            $qItem = "SELECT itemNumber FROM item WHERE itemNumber = '$itemNumber' ";
            $itemStatement = $deal->prepare($qItem);
            $itemStatement->execute(['itemNumber'=> $itemNumber]);

            if($itemNumber->rowCount() > 0) {

                /* item exist in DB */
                $delItem = "DELETE FROM item WHERE itemNubmer = '$itemNumber' ";
                $delItemStatement = $deal->prepare($delItem);
                $delItemStatement->execute(['itemNumber'=> $itemNumber]);

                    echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>
                                Item deleted.</div>';
                    exit();
                } else {
                    /* item does not exist */
                    echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>
                               Item does not exist in DB.</div>';
                    exit();
                }
            } else {
                /* itemNumber is empty */
                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times</button>
                           Enter the item number</div>';
                exit();
            }
    }
?>