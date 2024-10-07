<?php

    require '../includes/functions.php';

    if(isset($_GET['id'])) {
        deletePurchase($_GET['id']);
        header("Location: manage_purchases.php");
        exit();
    } else {
        header("Location:manage_purchases.php");
        exit();
    }
?>