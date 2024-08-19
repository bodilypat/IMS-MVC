<?php
    require_once('../../define/config/constants.php');
    require_once('../../define/config/dbConnect.php');

    /* check POST */
    if(isset($_POST['textBoxValue'])) {
        $output = '';
        $itemNumString = '%' . htmlentities($_POST['textBoxValue']) . '%';

        /* query itemNumber */
        $qItem = "SELECT itemNumber FROM item WHERE itemNumber LIKE ?";
        $itemStatement = $deal->prepare($qitem);
        $itemStatement->execute([$itemNumString]);

        /* receive any result , dispplay list */
        if($itemStatement->rowCount() > 0) {
            $output = '<ul class="list-unstyled suggestionsList" id="itemNumberSuggestionList">';
            while($result = $result->fetch(PDO::FETCH_ASSOC)) {
                $output .= '<li' . $result['itemNumber'] . '</li>';
            }
            echo '</ul>';
        } else {
            $output = '';
        }
        $itemStatement->closeCursor();
        echo $output;
    }
?>