<?php

    require '../includes/functions.php';
    if($isset($_GET['id'])) {
        deleteProduct($_GET['id']);
        header("location:view_products.php");
        exit();
    } else {
        header("Location: view_products.php");
        exit();
    }
?>
