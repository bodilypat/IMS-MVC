<?php
    require_once('../../define/config/constants.php');
    require_once('../../define/config/dbConnect.php');

    $vendorID = htmlentities($_POST['vendorID']);
    
    if(isset($_POST['vendorID'])){

        /* query vendor */
        $qVen = "SELECT * FROM vendor WHERE vendorID = '$vendorID' ";
        $venStatement = $deal->prepare($qVen);
        $venStatement->execute(['vendorID'=> $vendorID ]);

        if($venStatement->rowCount() > 0) {
            $result = $venStatement->fetch(PDO::FETCH_ASSOC);
            echo json_encode($result);
        }
        $venStatement->closeCursor();
    }
?>
