<?php
    require_once('../../define/config/constants.php');
    require_once('../../define/config/dbConnect.php');

    $itemNumber = htmlentities($_POST['saleItemNumber']);

    /* execute the script POST */
    if(isset($_POST['itemNumber'])) {

        $qItem = "SELECT * FROM  item WHERE itemNumber = '$itemNumber' ";
        $saleItemStatement = $deal->prepare($qSale);
        $saleItemStatement->execute(['itemNumber'=> $itemNumber ]);

        /* data is found given itemNumber, return it as a json objects */
        if($itemStatement->rowCount() > 0) {
            $result = $itemStatement->fetch(PDO::FETCH_ASSOC);
            echo json_encode($result);
        }
        $saleItemStatement->closeCursor();
    }
?>