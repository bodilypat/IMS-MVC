<?php
     require_once('../../define/config/constants.php');
     require_once('../../define/config/dbconnect.php');
     /* execute post request is submitted */
     if(isset($_POST['itemNumber']))
     {
        $itemNumber = htmlentities($_POST['itemNumber']);

        $qItem = "SELECT * FROM item WHERE itemNumber= '$itemNumber'";
        $itemStatement = $dbcon->prepare($qItem);
        $itemStatment->execute(['itemNumber' => $itemNumber]);

        /* get item object , return it as a json object */
        if($itemStatement->rowCount() > 0)
        {
            $resultset = $itemStatement->fetch(PDO::FETCH_ASSOC);
            echo json_endcode($resultset);
        }
        $itemStatement->closeCursor();
     }
?>