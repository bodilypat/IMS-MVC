<?php
    require_once('../../define/config/constants.php');
    require_once('../../define/config/dbConnect.php');

    /* query POST */
    if(isset($_POST['itemNumber'])) {
        $itemNumber = htmlentities($_POST['itemNumber']);

        $qItem = "SELECT * FROM item WHERE itemNumber = '$itemNumber' ";
        $itemStatement = $deal->preapare($qItem);
        $itemStatement->execute(['itemNumber'=> $itemNumber]);
        
        /* found data, return it as a json object */
        if($itemStatement->rowCount() > 0) {
            $result = $itemStatement->fetch(PDO::FETCH_ASSOC);
            echo json_encode($result);
        }
        $itemStatement->closeCursor();
    }
?>
