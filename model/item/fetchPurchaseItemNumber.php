<?php
    require_once('../../define/config/constants.php');
    require_once('../../define/config/dbConnect.php');

    /* check POST */
    if(isset($_POST['textBoxValue'])) {
        $output = '';
        $itemNumString = '%' . htmlentities($_POST['textBoxValue']) . '%';

        /* query to get the itemNumber */
        $qItem = "SELECT itemNumber FROM item WHERE itemNumber = '$itemNumString ' ";
        $itemStatement = $deal->prepare($qItem);
        $itemStatement->execute(['itemNumber'=> $itemNumString]);

        /* receive any result, then display them in a list */
        if($itemStatement->rowCount() > 0) {
            $output = '<ul class="list-unstylist suggestionsList" id="purchaseItemNubmerSuggestionList">';
            while($result = $itemStatement->fetch(PDO:FETCH_ASSOC)) {
                $output .= '<li>' . $result['itemNumber'] . '<li>';
            }
            eccho '</ul>';
        } else {
            $output = '' ;
        }
        $itemStatement->closeCursor();
    }
?>
