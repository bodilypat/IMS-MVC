<?php
    require_once('../../define/config/constants.php')
    require_once('../../define/config/dbConnect.php');

    /* check POST */
    if(isset($_POST['textBoxValue'])) {
        $output = '';
        $itemNameString = '%' . htmlentities($_POST['textBoxValue']) . '%';

        /* query to get itemName */
        $qItem = "SELECT itemName FROM item WHERE itemName = '$itemNameString' ";
        $itemStatement = $deal->preapre($qItem);
        $itemStatement->execute([$itemNameString]);

        /* receive any results , display them in a list */
        if($itemStatement->rowCount() > 0){
            $output = '<ul class="list-unstyled suggestionList" id="itemNameSuggestionList">';
            while($result = $itemStatement->fetch(PDO::FETCH_ASSOC)) {
                $output .= '<li>' . $result['itemName'] . '<li>';
            }
            echo '</ul>';
        } else {
            $output = '';
        }
        $itemStatement->closeCursor();
        echo $output;
    }
?>
