<?php
    require_once('../../define/config/constants.php');
    require_once('../../define/config/dbConnect.php');

    $purchaseID = htmlentities($_POST['purchaseID']);

    if(isset($_POST['purchaseID'])) {

        /* query purchase */
        $qPurch = "SELECT * FROM purchase WHERE purchaseID = '$purchaseID' ";
        $purchaseStatement = $deal->prepare($qPurch);
        $purchaseStatement->execute(['purchaseID'=> $purchaseID ]);

        /* found data given purchaseID, return it as a json object */
        if($purchaseStatement->rowCount() > 0) {
            $result = $purchaseStatement->fetch(PDO::FETCH_ASSOC);
            echo json_encode($result);
        }
        $purchaseStatement->closeCursor();
    }
?>