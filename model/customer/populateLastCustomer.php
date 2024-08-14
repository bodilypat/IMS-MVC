<?php
    require_once('../../define/config/constant.php');
    require_once('../../define/config/dbConnect.php');

    $qCust = "SELECT MAX(customerID) FROM customer";
    $custStatement = $deal->prepare($qCust);
    $custStatement->execute();

    $result = $custStatement->fetch(PDO::FETCH_ASSOC);
    echo $result['MAX(customerID)'];
    $custStatement->closeCursor();
?>