<?php
    require_once('../../define/config/constants.php');
    require_once('../../define/config/dbConnect.php');

    /* check POST */
    if(isset($_POST['textBoxValue'])) {
        $output = '';
        $itemNumString = '%' . htmlentities($_POST['textBoxValue']) . '%';

        /* query get itemNumber */
        $qItem = "SELECT itemNumber FROM item WHERE itemNumber LIKE ? ";
        $itemStatement = $deal->prepare($qItem);
        $itemStatement->execute([$itemNumString]);

        /* receive result , display list */
        if($itemStatement->rowCount() > 0 ){
            $output = '<ul class="list-unstyled suggestionList" id="itemImageNumberSuggestionList">';
            while($result = $itemStatement->fetch(PDO:FETCH_ASSOC)) {
                $output .= '<li>' . $result['itemNumber'] . '</li>';
            }
            echo '</ul>';
        } else {
            $output = '';
        }
        $itemStatement->closeCursor();
        echo $output;
    }
?>
