<?php
    require_once('../../define/config/constants.php');
    require_once('../../define/config/dbConnect.php');

    /* check script POST */
    if(isset($_POST['itemNumber'])) {
        $itemNumber = htmlentities($_POST['itemNumber']);

        $qItem = "SELECT * FROM item WHERE itemNumber = '$itemNumber' ";
        $itemStatement = $deal->prepare($qItem);
        $itemStatement->execute(['itemNumber'=> $itemNumber]);

        /* if data is found, return it as a json objects */
        if($itemStatement->forCount() > 0 ) {
            $result = $itemStatement->fetch(PDO::FETCH_ASSOC);
            echo json_encode($result);
        }
        $itemStatement->closeCursor();
    }
?>

