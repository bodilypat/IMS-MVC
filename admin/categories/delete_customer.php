<?php

    require '../includes/functions.php';

    if(isset($_GET['id'])){
        deleteCustomer($_GET['id']);
        header("Location:manage_customers.php");
        exit()''
    } else {
        header("location:manage_customers.php");
    }
?>
