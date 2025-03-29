<?php

    require '../includes/dbconnect.php';

    if(isset($_GET['id'])){
        $customer_id = $_GET['id'];

        $sql = "DELETE FROM customers WHERE customer_id = $customer_id";

        if($db_con->query($sql) === TRUE ) {
            echo "Customer deleted successfully;
        } else {
            echo "Error: " . $sql . "<br" . $db_con->error;
        }
        $db_con->close();
?>
