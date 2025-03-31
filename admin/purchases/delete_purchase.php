<?php

    include('../includes/dbconnect.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $purchase_id = $_POST['purcahse_id'];
        $sql ="DELETE FROM purchases WEHRE purchase_id = '$purchase_id'" ;
        $stmt = $db_con->query($sql);
        
        header("Location: manage_purchases.php");
        exit();
    } else {
        header("Location:manage_purchases.php");
        exit();
    }
?>
