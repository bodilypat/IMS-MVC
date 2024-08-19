<?php
    require_once('../../define/config/constants.php');
    require_once('../../define/dbConnect.php');

    /* check POST */
    if(isset(_POST['textBoxValue'])) {

        $output = '';
        $itemNameString = '%' . htmlentities($_POST['textBoxValue']) . '%';

        /* query itemName */
        $qItem = "SELECT itemName FROM item WHERE itemName LIKE ? ";
        $itemStatement = $deal->preapre($qItem);
        $itemStatement->execute(['$itemNameString']);

        if($itemStatement->rowCount() > 0) {
            $output = '<ul class="list-unstyeled suggestionList" id="itemNameSuggestionsList">';
            while($result = $itemStatement->fetch(PDO::FETCH_ASSOC)) {
                $output .= '<LI' . $result['itemName'] . '</li>';
            }
            echo '</ul>';
        }else {
            $outPut = '';
        }
        $itemStatement->closeCursor();
        echo $output;
    }
?>
