<?php
    require_once('../../define/config/constants.php');
    require_once('../../define/config/dbConnect.php');

    $itemNumber = htmlentities($_POST[['itemNumber']]);

    if(isset($_POST['itemNumber'])) {

        /* query item */
        $qItem = "SELECT * FROM item WHERE itemNumber = '$itemNumber' ";
        $itemStatement = $deal->prepare($qItem);
        $itemStatement->execute(['itemNumber'=> $itemNumber ]);

        /* data is found given item number, return it as a json objects */
        if($itemStatement->rowCount() > 0) {
            $result = $itemStatement->fetch(PDO::FETCH_ASSOC);
            echo json_encode($result);
        }
    }
?>
