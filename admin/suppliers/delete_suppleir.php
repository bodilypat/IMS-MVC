<?php

    require '../includes/functions.php';

    if(isset($_GET['id'])){
        deleteSupplier($_GET['id']);
        header("Location:manage_suppliers.php");
        exit();
    } else {
        header('Location:manage_supplier.php');
        exit();
    }