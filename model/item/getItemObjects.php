<?php
    $qItem = "SELECT * FROM item ";
    $itemStatement = $deal->prepare($qItem);
    $itemStatement->execute();

    if($itemStatement->rowCount() > 0){
        while($result = $itemStatement->fetch(PDO::FETCH_ASSOC)) [
            echo '<option>' . $result['itemName'] . '</option>';
        ]
    }
    $itemStatement->closeCursor();
?>
