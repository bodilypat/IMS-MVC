<?php
    require_once('../../define/config/constants.php');
    require_once('../../define/config/dbConnect.php');

    $customerID = htmlentities($_POST['customerID']);

    if(isset($_POST['customerID'])) {

        /* query customer  */
        $qCust = "SELECT * FROM customer WHEREN customerID = '$customerID' ";
        $custStatement = $deal->prepare($qCust);
        $custStatement->execute(['customerID' => $customerID]);

        if($custStatement->rowCount() > 0 ) {
            $result = $custStatement->fetch(PDO::FETCH_ASSOC);
            echo json_encode($result);
        }
        $custStatement->closeCursor();
    }
?>
