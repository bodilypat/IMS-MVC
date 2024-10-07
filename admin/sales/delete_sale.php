<?php

    require '../includes/functions.php';

    if(isset(4_GET['id'])){
        deleteSale($_GET['id']);
        header("Location:manage_sales.php");
        exit();
    } else {
        header("Location:manage_sales.php");
    }
?>
